 <?php
class Whatsapp_model extends CI_Model
{


    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */
    
    function __construct()
    {
        parent::__construct();
    }

    
    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('whatsapp_msg_codigo', 'desc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id)
    {
        $this->db->where('marca_codigo', $id);
        $this->db->limit(1);
        return $this->db->get('tb_marca')->row();
    }
    
    function enviar($num_destino, $mensagem)
    {
       // $this->db->insert($table, $data);
        //if ($this->db->affected_rows() == '1') {
        //    return true;
        //}
        

    //--API PARAMETERS ENCODED AS JSON--
    //$JSON_DATA = '{"token":"API_TOKEN_XXXXXXX","priority ":0,"application":"1","sleep":0,"globalmessage":"test","globalmedia":"","data":[{"number":"MOBILE_NUMBER_1_WITH_COUNTRY_CODE","message":""},{"number":"MOBILE_NUMBER_2_WITH_COUNTRY_CODE","message":""}]}';

    $JSON_DATA = '{"token":"e914220180670b328f68c031b6a217d3a4470da4","priority":0,"application":"1","sleep":0,"globalmessage":"Teste","globalmedia":"","data":[{"number":"'.$num_destino.'","message":"'.$mensagem.'"}]}';
  

    //--CURL FUNCTION TO CALL THE API--
    $url = 'http://pickyassist.com/app/api/v2/push';

    $ch = curl_init($url);                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON_DATA);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($JSON_DATA))                                                                       
    );                                                                                                                   
                                                                                                                            
    $result = curl_exec($ch);

        //return $result;

        //end;

    //--API RESPONSE--
    //print_r( json_decode($result,true) );


        /*Mobile number with country code from the message came, 
        if the sender mobile number is saved in the phone contacts then instead of number the contact name will come here as number. 
        For Whatsapp Group the number will be Group Name @Sender Name / Number */
        //$mobile_number = isset($_REQUEST['number']) ? $_REQUEST['number'] : 0;

        /*Text message received in the application - only first 1000 characters will be pushed to the server.*/
        //$msg = isset($_REQUEST['message-in']) ? $_REQUEST['message-in'] : 0;

        /*On which messaging app the message has received 1=Whatsapp Personal | 2 = Whatsapp Business*/
        //$application = isset($_REQUEST['application']) ? $_REQUEST['application'] : 0;

        /*What kind of message is received , text=1, photo=2, video=3, audio=4, location=5, document=6, contact=7*/
        //$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 0;

        /*Unique id assigned by the picky assist application*/
        //$uniqueid = isset($_REQUEST['unique-id']) ? $_REQUEST['unique-id'] : 0;

        //if (!empty($mobile_number)) {
        /*Reply should be in JSON format. The response parameters are : 
        1. 'message-out' - Message you need to give it as reply.
        2. 'delay' - If you would like to give response by setting a delay then please pass the delay value 
        in “delay” variable , delay need to be set in seconds and maximum allowed delay is 3600 seconds 
        i.e delay=10 means message will send after 10 seconds
        */

        /*Giving Reply should be in JSON*/
       // $data = array('message-out' => ' Hello Picky','delay' => 0);

       // echo json_encode($data);
       // }



    
    }
    
    function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        
        return false;
    }
    
    function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return true;
        }
        
        return false;
    }
    
    function count($table)
    {
        return $this->db->count_all($table);
    }
}
