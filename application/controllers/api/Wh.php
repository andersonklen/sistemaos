<?php
   
   require APPPATH . '/libraries/REST_Controller.php';
   use Restserver\Libraries\REST_Controller;
     
class Wh extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{

                  
        /*Mobile number with country code from the message came, 
        if the sender mobile number is saved in the phone contacts then instead of number the contact name will come here as number. 
        For Whatsapp Group the number will be Group Name @Sender Name / Number */
        $mobile_number = isset($_REQUEST['number']) ? $_REQUEST['number'] : 0;

        /*Text message received in the application - only first 1000 characters will be pushed to the server.*/
        $msg = isset($_REQUEST['message-in']) ? $_REQUEST['message-in'] : 0;

        /*On which messaging app the message has received 1=Whatsapp Personal | 2 = Whatsapp Business*/
        $application = isset($_REQUEST['application']) ? $_REQUEST['application'] : 0;

        /*What kind of message is received , text=1, photo=2, video=3, audio=4, location=5, document=6, contact=7*/
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 0;

        /*Unique id assigned by the picky assist application*/
        $uniqueid = isset($_REQUEST['unique-id']) ? $_REQUEST['unique-id'] : 0;

        //if (!empty($mobile_number)) {
        /*Reply should be in JSON format. The response parameters are : 
        1. 'message-out' - Message you need to give it as reply.
        2. 'delay' - If you would like to give response by setting a delay then please pass the delay value 
        in “delay” variable , delay need to be set in seconds and maximum allowed delay is 3600 seconds 
        i.e delay=10 means message will send after 10 seconds
        */





            $data1 = array(
                'marca_nome' => 'ativo',
                'marca_website' => 'ativo',
                'marca_situacao' => 'ativo',
                'marca_data_cadastro' => date('Y-m-d H:i:s'),
                'marca_data_ultima_alteracao' => date('Y-m-d H:i:s'),
                'marca_deletado' => 'nao',
            );            

            $this->db->insert('tb_marca', $data1);
        
        
        /*Giving Reply should be in JSON*/
       $data = array('message-out' => ' Hello Picky','delay' => 0);

       echo json_encode($data);
       
         
            $this->response($data, REST_Controller::HTTP_OK);
	}
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {



     /*Mobile number with country code from the message came, 
        if the sender mobile number is saved in the phone contacts then instead of number the contact name will come here as number. 
        For Whatsapp Group the number will be Group Name @Sender Name / Number */
        $mobile_number = isset($_REQUEST['number']) ? $_REQUEST['number'] : 0;

        /*Text message received in the application - only first 1000 characters will be pushed to the server.*/
        $msg = isset($_REQUEST['message-in']) ? $_REQUEST['message-in'] : 0;

        /*On which messaging app the message has received 1=Whatsapp Personal | 2 = Whatsapp Business*/
        $application = isset($_REQUEST['application']) ? $_REQUEST['application'] : 0;

        /*What kind of message is received , text=1, photo=2, video=3, audio=4, location=5, document=6, contact=7*/
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 0;

        /*Unique id assigned by the picky assist application*/
        $uniqueid = isset($_REQUEST['unique-id']) ? $_REQUEST['unique-id'] : 0;

        //if (!empty($mobile_number)) {
        /*Reply should be in JSON format. The response parameters are : 
        1. 'message-out' - Message you need to give it as reply.
        2. 'delay' - If you would like to give response by setting a delay then please pass the delay value 
        in “delay” variable , delay need to be set in seconds and maximum allowed delay is 3600 seconds 
        i.e delay=10 means message will send after 10 seconds
        */

        
  $data1 = array(
                'marca_nome' => 'ativo',
                'marca_website' => 'ativo',
                'marca_situacao' => 'ativo',
                'marca_data_cadastro' => date('Y-m-d H:i:s'),
                'marca_data_ultima_alteracao' => date('Y-m-d H:i:s'),
                'marca_deletado' => 'nao',
            );            

            $this->db->insert('tb_marca', $data1);
        
        
        /*Giving Reply should be in JSON*/
       $data = array('message-out' => ' Hello Picky','delay' => 0);

       echo json_encode($data);
       
         
            $this->response($data, REST_Controller::HTTP_OK);


    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('products', $input, array('id'=>$id));
     
        $this->response(['Product updated successfully.'], REST_Controller::HTTP_OK);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('products', array('id'=>$id));
       
        $this->response(['Product deleted successfully.'], REST_Controller::HTTP_OK);
    }
    	
}