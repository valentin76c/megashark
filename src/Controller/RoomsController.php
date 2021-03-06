<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Date;

/**
 * Rooms Controller
 *
 *
 * @method \App\Model\Entity\Room[] paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $rooms = $this->paginate($this->Rooms);

        $this->set(compact('rooms'));
        $this->set('_serialize', ['rooms']);
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => []
        ]);
        
        // On initialise le tableau contenant les séances
        $seance = array(
            1 => array(),
            2 => array(),
            3 => array(),
            4 => array(),
            5 => array(),
            6 => array(),
            7 => array()
        );
        
        $weekStart = new Time(strtotime('monday this week'));
        $weekEnd = new Time(strtotime('sunday this week'));
        
        // On effectue la requête pour obtenir les instanes des séances en question
        $query = TableRegistry::get('showtimes')->find();
        $query->where(['room_id' => $room->id]);
        $query->where(['start >=' => $weekStart]);
        $query->where(['start <=' => $weekEnd]);
        $query->order(['start']);
        
        // On parcourt toutes les instances trouvées
        foreach ($query as $data) {
            // On associe l'ID du film au film correspondant
            $queryFilm = TableRegistry::get('movies')->find();
            $movieName = $queryFilm->where(['id' => $data->movie_id])->first();
            
            // On parse sous le format correspondant les horaires
            $date = new Time($data->start);
            $dateBegin = $date->format('H\hm');
            $date = new Time($data->end);
            $dateEnd = $date->format('H\hm');
            
            // On ajoute le texte dans le tableau de résultat sous le jour correspondant
            $seance[$data->start->format('N')][] = "$movieName->name<br>$dateBegin / $dateEnd";
            
        }
        
        // On retourne dans le view les variables
        $this->set('room', $room);
        $this->set('_serialize', ['room']);
        $this->set('seance', $seance);
        $this->set('_serialize', ['seance']);
        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $room = $this->Rooms->newEntity();
        if ($this->request->is('post')) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $this->set(compact('room'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $this->set(compact('room'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);
        if ($this->Rooms->delete($room)) {
            $this->Flash->success(__('The room has been deleted.'));
        } else {
            $this->Flash->error(__('The room could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
