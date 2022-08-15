<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\DistanceMatrix;
use App\Models\MemberTravelInfo;
use App\Models\MemberTravelInfoDetails;
use App\Models\DaManagement;
use App\Models\TaManagement;
use App\Models\Section;
use Session;
use Auth;
use mysqli;
use mysql;
use Validator;
use App\Http\Requests;

class ExportImportController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        if (is_null($this->user) ||  !$this->user->can('ex_import')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $data['title'] = 'HMS | Database Export and Import';

        return view('export_import', $data);
    }

    public function getExport()
    {
        if (is_null($this->user) ||  !$this->user->can('export')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $backup_name = 'hms_backup'.date("d_m_Y_H_i_s").'.sql';
        // MySQL host
        $mysql_host = config('database.connections.'.config('database.default').'.host');
        // MySQL username
        $mysql_port = config('database.connections.'.config('database.default').'.port');
        $mysql_username = config('database.connections.'.config('database.default').'.username');
        // MySQL password
        $mysql_password = config('database.connections.'.config('database.default').'.password');
        // Database name
        $mysql_database = config('database.connections.'.config('database.default').'.database');

        //dd($mysql_database);
        // Connect to MySQL server

        $mysqli = new mysqli($mysql_host.":".$mysql_port, $mysql_username, $mysql_password);
        $mysqli->select_db($mysql_database);
        $mysqli->query("SET NAMES 'utf8'");
        $mysqli->query("SET CHARACTER SET utf8");
        $mysqli->query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

        $queryTables    = $mysqli->query('SHOW TABLES');
        while($row = $queryTables->fetch_row())
        {
            $target_tables[] = $row[0];
        }

        //  $not_exportable_table = ['users', 'section', 'rank', 'districts','unit','allowance','house','loan','da_management','thana'];

        $content  = "\r\n"."SET NAMES 'utf8';";
        $content .= "\r\n".'SET FOREIGN_KEY_CHECKS=0;';

        $content .= "\r\n"."DROP TABLE IF EXISTS `users`, `profile_models`, `meals`, `report_models`, `token_sells`, `barcode_models`, `security_models`,  `migrations`, `password_resets`;";

        $content .= "\r\n"."SET NAMES 'utf8';";
        $content .= "\r\n".'SET FOREIGN_KEY_CHECKS=0;';

        foreach($target_tables as $table)
        {
            // if(!in_array($table, $not_exportable_table))
            if(!empty($table))
            {
                $result         =   $mysqli->query('SELECT * FROM '.$table);

                //dd($result);

                $fields_amount  =   $result->field_count;
                $rows_num       =   $mysqli->affected_rows;
                $res            =   $mysqli->query('SHOW CREATE TABLE '.$table);
                $TableMLine     =   $res->fetch_row();
                $content        .=  "\r\n".$TableMLine[1].";\r\n";

                for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0)
                {
                    while($row = $result->fetch_row())
                    { //when started (and every after 100 command cycle):
                        if ($st_counter%100 == 0 || $st_counter == 0 )
                        {
                            $content .= "\r\nINSERT INTO ".$table." VALUES";
                        }
                        $content .= "\r\n(";
                        for($j=0; $j<$fields_amount; $j++)
                        {
                            $row[$j] = str_replace("\r\n","\r\n", addslashes($row[$j]) );
                            if (isset($row[$j]))
                            {
                                $content .= '"'.$row[$j].'"' ;
                            }
                            else
                            {
                                $content .= '""';
                            }
                            if ($j<($fields_amount-1))
                            {
                                $content.= ',';
                            }
                        }
                        $content .=")";
                        //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                        if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num)
                        {
                            $content .= ";";
                        }
                        else
                        {
                            $content .= ",";
                        }
                        $st_counter=$st_counter+1;
                    }
                } $content .="\r\n\r\n";
            }
        }
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";

        $backup_name = $backup_name ? $backup_name : $mysql_database.".sql";
        // dd($backup_name);
        header('Content-Type: text/html; charset=utf-8');
        //header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");
        header('Pragma: public');
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $content; exit;
    }

    public function postImport(Request $request)
    {
        if (is_null($this->user) ||  !$this->user->can('import')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        //dd($request);
        // dd($_FILES);
        // Name of the file
        $filename = $_FILES['uploaded_file']['tmp_name'];
        //$filename = $_FILES['uploaded_file']['name'];
        //dd($filename);
        if(empty($filename))
        {
            return redirect('ex-import')->with('error_message', 'Please select databse!');
        }
        // MySQL host
        $mysql_host = config('database.connections.'.config('database.default').'.host');
        // MySQL username
        $mysql_port = config('database.connections.'.config('database.default').'.port');
        $mysql_username = config('database.connections.'.config('database.default').'.username');
        // MySQL password
        $mysql_password = config('database.connections.'.config('database.default').'.password');
        // Database name
        $mysql_database = config('database.connections.'.config('database.default').'.database');
        //dd($mysql_database);
        // Connect to MySQL server
        $mysqli = new mysqli($mysql_host.":".$mysql_port, $mysql_username, $mysql_password);
        $mysqli->select_db($mysql_database);
        //dd($mysqli);
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        //file_get_contents
        //dd((sys_get_temp_dir().$filename));
        $lines = file($filename);
        //dd($lines);
        //$lines = file_get_contents($filename);
        //dd($lines);
        // Loop through each line
        foreach ($lines as $line)
        {
            //dd($line);
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(($line), -1, 1) == ';')
            {
                // Perform the query
                $mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                // Reset temp variable to empty
                $templine = '';
            }
        }
        return redirect('ex-import')->with('success_message', 'Database successfully synchronized!');
        //echo "Tables imported successfully";
    }

}
