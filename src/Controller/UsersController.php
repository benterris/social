<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['welcome', 'logout', 'add']);
    }   
    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
    
    public function friends()
    {
        $loggedIn = $this->Auth->user();
        $users = $this->paginate($this->Users);

        $this->set(compact('users', 'loggedIn'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
    
    public function wall($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        
        $owner = 0; //set to 1 if the wall page is the one of the current user (so it can be editable)
        $loggedIn = $this->Auth->user();
        
        /*
        $connection = ConnectionManager::get('default');
        //$result = $connection->execute('SELECT * FROM posts, users WHERE user_id_receiver = ?', [$loggedIn['id']]);
        $result = $connection->execute('SELECT p.content, p.created, p.user_id_sender, u.username FROM posts AS p, users AS u WHERE p.user_id_receiver = ? AND u.id = p.user_id_sender ORDER BY created DESC', [$id]);
              
        $posts = $result->fetchAll('assoc');
         * 
         */
        
        $postsTable = TableRegistry::get('Posts');
        $query = $postsTable->find('all', ['contain' => ['Sender', 'Receiver']])
                ->where(['OR' => [['user_id_receiver' => $id], [['user_id_sender' => $id], ['user_id_receiver' => -1]]]])
                ->order(['created' => 'DESC']);
        $posts = $this->paginate($query);
        
        
        
        /*
        $postsTable = TableRegistry::get('Posts');
        $query = $postsTable->find('all');
        $query->contain([
            'Posts' => function ($q) {
                return $q->where(['Posts.user_id_receiver' => $loggedIn['id']]);
            }, 
            'Users' => function ($q) {
                return $q->select(['username'])
                        ->where(['User.id' => $loggedIn['id']]);
            }
        ]);
        
         * $posts = $query->toArray();
         * 
         */
        
        
        if ($loggedIn['id'] == $id) {
            $owner = 1;
        }
        
        $newPost = $postsTable->newEntity();
        
        if ($this->request->is('post')) {
            
            $newPost = $postsTable->patchEntity($newPost, $this->request->getData());
            $newPost->user_id_sender = $this->Auth->user()['id'];
            $newPost->user_id_receiver = $id;
            $newPost->created = Time::now();
            if ($postsTable->save($newPost)) {
                return $this->redirect(['action' => 'wall', $id]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
            
        }
        $this->set(compact('newPost'));
        $this->set('_serialize', ['newPost']);
        
        
        $this->set(compact('user', 'owner', 'loggedIn', 'posts'));   
    }
    
    public function timeline()
    {
        
        
        
        $loggedIn = $this->Auth->user();
        /*
        $connection = ConnectionManager::get('default');
        //$result = $connection->execute('SELECT * FROM posts, users WHERE user_id_receiver = ?', [$loggedIn['id']]);
        $result = $connection->execute('SELECT p.content, p.created, p.user_id_sender, p.user_id_receiver, us.username AS usernameSend, ur.username AS usernameReceive FROM posts AS p, users AS us, users AS ur WHERE (ur.id = p.user_id_receiver OR (p.user_id_receiver = -1 AND ur.id = 0)) AND us.id = p.user_id_sender ORDER BY created DESC');
              
        $posts = $result->fetchAll('assoc');
         * 
         */
        
        
        /*
        $postsTable = TableRegistry::get('Posts');
        $query = $postsTable->find('all');
        $query->contain([
            'Posts' => function ($q) {
                return $q->where(['Posts.user_id_receiver' => $loggedIn['id']]);
            }, 
            'Users' => function ($q) {
                return $q->select(['username'])
                        ->where(['User.id' => $loggedIn['id']]);
            }
        ]);
        
         * $posts = $query->toArray();
         * 
         */
        
        $postsTable = TableRegistry::get('Posts');
        $query = $postsTable->find('all', ['contain' => ['Sender', 'Receiver']])
                ->order(['created' => 'DESC']);
        $posts = $this->paginate($query);
        
        
        $newStatus = $postsTable->newEntity();
        
        if ($this->request->is('post')) {
            
            $newStatus = $postsTable->patchEntity($newStatus, $this->request->getData());
            $newStatus->user_id_sender = $this->Auth->user()['id'];
            $newStatus->user_id_receiver = -1;
            $newStatus->created = Time::now();
            if ($postsTable->save($newStatus)) {
                return $this->redirect(['action' => 'timeline']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
            
        }
        
        
        
        
        
        $this->set(compact('loggedIn', 'posts', 'newStatus'));
        $this->set('_serialize', ['newStatus', 'posts']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
                
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Welcome ' . $user->username . ' !'));
                
                $user = $this->Auth->identify();
                if($user){
                    $this->Auth->setUser($user); 
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('Saving ok, but login wrong.'));
                
                //return $this->redirect(['action' => 'friends']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
        $this->redirect(['action' => 'welcome']);
    }
    
    
    public function login()
    {
        
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            
            if($user){
                $this->Flash->success('Hi ' . $user['username'] . ' !');
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
                
            $this->Flash->error('Wrong username/password : ' . $this->request->getData('username') . ", " . $this->request->getData('password'));
        }
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    public function welcome()
    {
        $user = $this->Users->newEntity();
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    
    public function editProfile($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $loggedIn = $this->Auth->user();
        
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            $uploaddir = getcwd() . '/webroot/img/profilePix/';
            $uploadfile = $uploaddir . basename($_FILES['submittedFile']['name']);
            $path_name = 'profilePix/' . basename($_FILES['submittedFile']['name']);
            
            if (move_uploaded_file($_FILES['submittedFile']['tmp_name'], $uploadfile)) {
                $user->picture_path = $path_name;
                $this->Flash->error("Paht : " . $uploadfile);
            } else {
                $this->Flash->error("Error uploading the file");
            }
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Modifications saved.'));

                return $this->redirect(['action' => 'friends']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'loggedIn'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
