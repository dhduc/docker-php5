<?php  
    header('Content-Type: text/html; charset=utf-8');
	class Database {
		// Biến lưu trữ kết nối
    private $__conn;
    
    // Hàm Kết Nối
    function __construct()
    {
        // Nếu chưa kết nối thì thực hiện kết nối
        if (!$this->__conn){
            // Kết nối
            $this->__conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('Lỗi kết nối');

            // Xử lý truy vấn UTF8 để tránh lỗi font
            mysqli_query($this->__conn, "set names 'utf8'");

            date_default_timezone_set("Asia/Ho_Chi_Minh");
        }
    }

    // Hàm Ngắt Kết Nối
    function __destruct(){
        // Nếu đang kết nối thì ngắt
        if ($this->__conn){
            mysqli_close($this->__conn);
        }
    }

    function query($sql){
        return mysqli_query($this->__conn, $sql);
    }

    // Hàm Insert
    function insert($table, $data)
    {
        

        // Lưu trữ danh sách field
        $field_list = '';
        // Lưu trữ danh sách giá trị tương ứng với field
        $value_list = '';

        // Lặp qua data
        foreach ($data as $key => $value){
            $field_list .= ",$key";
            $value_list .= ",'".mysql_escape_string($value)."'";
        }

        // Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';

       return mysqli_query($this->__conn, $sql);
        // echo $sql;
    }

    // Hàm Update
    function update($table, $data, $where)
    {
      
        $sql = '';
        // Lặp qua data
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysql_escape_string($value)."',";
        }

        // Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;

        return mysqli_query($this->__conn, $sql);
        //echo $sql;
    }

    // Hàm delete
    function remove($table, $where){
      
        
        // Delete
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->__conn, $sql);
    }

    function delete_all($table){
        $sql = "DELETE FROM $table";
        return mysqli_query($this->__conn, $sql);
    }

    // Hàm lấy danh sách
    function get_list($sql)
    {
       
        $result = mysqli_query($this->__conn, $sql);

        if (!$result){
            echo $sql."<br>";
            die ('Câu truy vấn bị sai: function get_list()');
        }

        $return = array();

        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)){
            $return[] = $row;
        }

        // Xóa kết quả khỏi bộ nhớ
        mysqli_free_result($result);

        return $return;
    }

    // Hàm lấy 1 record dùng trong trường hợp lấy chi tiết tin
    function get_row($sql)
    {
       
        
        $result = mysqli_query($this->__conn, $sql);

        if (!$result){
             echo $sql."<br>";
            die ('Câu truy vấn bị sai: function get_row()');
        }

        $row = mysqli_fetch_assoc($result);

        // Xóa kết quả khỏi bộ nhớ
        mysqli_free_result($result);

        if ($row){
            return $row;
        }

        return false;
    }
		
	}

	
?>