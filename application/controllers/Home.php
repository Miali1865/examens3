<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    require_once('SessionManager.php');
    class Home extends SessionManager {
        protected $data = array();

        public function __construct() {
            parent::__construct();
            $this->load->model('admin_model','admin');
            $this->load->model('user_model','user');
            $this->data['title'] = 'Accueil - Examen';
            $this->data['nbrUser'] = $this->admin->countUser();
            $this->data['nbrEchange'] = $this->admin->countEchange();
            $this->data['page'] = 'index';
            $this->data['error'] = '';
            $this->data['admin'] = $this->admin->getAllCategorie();
            $id = $_SESSION['user']['idutilisateur'];
            $this->data['listObjet'] = $this->user->getListObject($id);           //récuperation des objets de l'utilisateur
        }


        public function index() {
            if(isset($_SESSION['data'])) {
                $this->data = $_SESSION['data'];
                $this->session->unset_userdata('data');
            }
            $this->data['title'] = 'accueil';

            $this->load->view('Template' , $this->data );
        }

        public function categorie() {
            $this->data['title'] = 'Accueil - categorie';
            $this->data['page'] = 'categorie';
            $this->categorielist();
        }

        public function categorielist() {
            $this->data['admin'] = $this->admin->getAllCategorie();
            $this->data['title'] = 'liste categorie - sakila';
            $this->session->set_userdata('data',$this->data);
            redirect('home');
        }

        public function listeObjet(){
            if(isset($_SESSION['data'])) {
                $this->data = $_SESSION['data'];
                $this->session->unset_userdata('data');
            }
            $this->data['page'] = 'listeObjet';
            $this->load->view('Template' , $this->data);
        }

        public function modifcateg($id = '') {
            $id = $this->input->get('id');
            $this->data['admin'] = $this->admin->getCatgorieById($id);
            $this->data['title'] = 'Accueil - categorie';
            $this->data['page'] = 'modifcategorie';
            $this->load->view('Template' , $this->data );
        }

        public function updatecateg() {
            try{
                $id = $this->input->get('id');
                $nom = $this->input->get('nom');
                $icone = $this->input->get('icone');
                $this->data['admin'] = $this->admin->modifyCategorie($id,$nom,$icone);
                redirect('home');
            }catch( Exception $e ){
                $this->data['erreur'] = $e->getMessage();
                $this->data['admin'] = $this->admin->getCatgorieById($id);
                $this->data['page'] = 'modifcategorie';
                $this->load->view('Template', $this->data);
            }
        }

        public function pageinsertobject() {
            $this->data['title'] = 'Insertion - objet';
            $this->data['page'] = 'insertObjet';
            $this->load->view('Template' , $this->data );
        }

        


        public function insertionObjet() {
            try{
                $titre = $this->input->get('titre');
                $prixestimatif = $this->input->get('prix');
                $id = $_SESSION['user']['idutilisateur'] ;
                $this->data['user'] = $this->user->insertObject( $titre , $id , $prixestimatif);
                redirect('home');
            }catch( Exception $e ){
                $this->data['erreur'] = $e->getMessage();
                $this->data['page'] = 'pageinsert';
                $this->load->view('Template', $this->data);
            }
        }

        public function myObjectInteresse() {
            $this->data['title'] = 'Liste echange';
            $this->data['page'] = 'listeEchange';
            $this->myListeChange();
        }

        public function myListeChange() {
            $id = 0;
            $id = $_SESSION['user']['idutilisateur'];
            var_dump($_SESSION);
            $this->data['objet'] = $this->user->listeEchange( $id );
            $this->data['title'] = 'liste proposition - sakila';
            $this->session->set_userdata('data',$this->data);
            ///Retour
            redirect('');
        } 

        public function detailChangeObjet() {
            $id = $_SESSION['user']['idutilisateur'];
            $idobjet = $this->input->get('idobjet');
            $this->data['objet'] = $this->user->listedetailEchange( $id , $idobjet);
            // echo $idobjet;
            $this->data['title'] = 'Detail - objet';
            $this->data['page'] = 'detailchange';
            $this->load->view('Template' , $this->data );
        }

        public function listcateg() {
            if(isset($_GET['objetoffrant'])) {
                $this->data['objetoffrant'] = $this->input->get('objetoffrant');
                $this->data['idoffrant'] = $this->input->get('offrant');
                $this->session->set_userdata('table',$this->data);
            }
            $this->data['title'] = 'listObject - objet';
            $this->data['page'] = 'listeObjet';
            $this->categorielist();
        }

        public function listeObject() {
            $this->data['title'] = 'Liste echange';
            $this->data['page'] = 'listeObjet';
            $idcategorie = $this->input->get('idcategorie');
            $id = $_SESSION['user']['idutilisateur'];
            $this->data['searchobjet'] = $this->user->searchObjet( $id ,  $idcategorie );
            $this->session->set_userdata('data',$this->data);
            redirect('home/listeObjet');
        }

        public function do_upload()
        {
                $idobjet = $this->input->post('idobjet');
                $config['upload_path']          = 'assets/imgs/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                $data = array('upload_data' => $this->upload->data());

                if ( ! $this->upload->do_upload('userfile'))
                {
                    echo 'Erreur';
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $this->data['user'] = $this->user->insertPhoto( $idobjet , $this->upload->data('file_name'));
                    // $this->load->view('Template' , $this->data );
                    redirect('home');
                }
        }

        public function insertIntoProposition() {
            try {
                if(isset($_SESSION['table'])) {
                    $this->table = $_SESSION['table'];
                    $this->session->unset_userdata('table');
                    $offrant = $this->table['idoffrant'];
                    $objetoffrant = $this->table['objetoffrant'];
                    $propose = $this->input->get('propose');
                    $objetpropose =  $this->input->get('objetpropose');
                    $estvalide = 1;
                    $this->data['objet'] = $this->user->insertProposition( $offrant , $propose , $objetoffrant , $objetpropose , $estvalide);
                    redirect('home');
                } else {
                    echo "Hellooo";
                }
            }catch ( Exception $e ) {
                $this->data['erreur'] = $e->getMessage();
            }

        }


        public function redirectDetailPhoto() {
            $this->data['title'] = 'Liste détail photo';
            $this->data['page'] = 'listeDetailPhoto.php';
            $this->detailPhoto();
        }

        public function detailPhoto() {
            $idobjet = $this->input->get('idobjet');
            $this->data['detailphotoobjet'] = $this->user->getPictureOfObject( $idobjet );
            $this->data['detailobjet'] = $this->user->getDetailObjet( $idobjet );
            $this->data['title'] = 'liste détail photo - sakila';
            $this->session->set_userdata('data',$this->data);
            redirect('home');
        } 
    }
?>