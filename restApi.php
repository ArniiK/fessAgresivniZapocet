<?php
require_once "inc/mysql_config.php";
session_start();
error_reporting(0);
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
//var_dump($method); echo("<br>");
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);   // php://input - read raw data from the request body
$key = array_shift($request) + 0;


switch ($method) {
    case 'GET':
        $result = "GET" . $key;
        break;
    case 'PUT':
        $result = "PUT" . $key;
        break;
    case 'POST':
        $result = "POST" . $key;
        break;
    case 'DELETE':
        $result = "DELETE" . $key;
        break;
}




if ($method == 'GET') {

    switch ($_GET["action"]) {
        case "vykonajPrikaz":
            $command = $_GET['prikaz'];

            $output = ltrim(shell_exec('octave --no-gui --quiet --eval "pkg load control;'. $command .'"'));

            echo $output;

            break;
        case "getDataKyvadlo":
            $apiKeyFromHeader = "";
            foreach (getallheaders() as $name => $value) {
                if($name==="api-key"){
                    $apiKeyFromHeader=$value;
                }
            }



            if($apiKeyFromHeader===$apiKey){
                $lastP = [];
                $lastR = $_GET['lastR'];
                $r = $_GET['r'];
                $last = $_GET['last'];
                if ($last === '0')
                    $lastP = [0,0,0,0];
                else {
                    $lastArr = preg_split('/:/', $last);
                    array_pop($lastArr);
                    foreach ($lastArr as $lastPos) {
                        array_push($lastP, $lastPos);
                    }
                }

                $command = "M = .5;
                        m = 0.2;
                        b = 0.1;
                        I = 0.006;
                        g = 9.8;
                        l = 0.3;
                        p = I*(M+m)+M*m*l^2;
                        A = [0 1 0 0; 0 -(I+m*l^2)*b/p (m^2*g*l^2)/p 0; 0 0 0 1; 0 -(m*l*b)/p m*g*l*(M+m)/p 0];
                        B = [ 0; (I+m*l^2)/p; 0; m*l/p];
                        C = [1 0 0 0; 0 0 1 0];
                        D = [0; 0];
                        K = lqr(A,B,C'*C,1);
                        Ac = [(A-B*K)];
                        N = -inv(C(1,:)*inv(A-B*K)*B);

                        sys = ss(Ac,B*N,C,D);
                        r = " . $r . ";
                        t = 0:0.05:10;
                        [y,t,x]=lsim(sys,r*ones(size(t)),t,[". implode(",", $lastP) ."]);
                        disp(x(:,1))
                        disp('endOfPos')
                        disp(x(:,3))
                        disp('endOfAng')
                        disp(x(size(x,1),:))
                        ";

                $output = ltrim(shell_exec('octave --no-gui --quiet --eval "pkg load control;'. $command .'"'));
                $oparray = preg_split('/\s+/', trim($output));
                $finalString="";
                foreach ($oparray as $entry){
                    $finalString =$finalString . $entry . " ";
                }
                $finalString = $finalString . "endOfLastP" . " " . $r . " " . $lastR;
                echo $finalString;
            }else{
                echo "unauthorized";
            }




            break;
        case "getDataTlmic":
            $lastP = [];
            $r = $_GET['r'];
            $last = $_GET['last'];
            if ($last === '0')
                $lastP = [0,0,0,0,0];
            else {
                $lastArr = preg_split('/:/', $last);
                array_pop($lastArr);
                foreach ($lastArr as $lastPos) {
                    array_push($lastP, $lastPos);
                }
            }
            $command = "
                        m1 = 2500; m2 = 320;
                        k1 = 80000; k2 = 500000;
                        b1 = 350; b2 = 15020;
                        A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];
                        B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];
                        C=[0 0 1 0]; D=[0 0];
                        Aa = [[A,[0 0 0 0]'];[C, 0]];
                        Ba = [B;[0 0]];
                        Ca = [C,0]; Da = D;
                        K = [0 2.3e6 5e8 0 8e6];
                        sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);
                        
                        t = 0:0.01:5;
                         r = " . $r . ";
                        [y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[". implode(",", $lastP) ."]);
                        disp(x(:,1))
                        disp('endOfPos')
                        disp(x(:,3)) 
                        disp('endOfAng')
                        disp(x(size(x,1),:))
                        ";

            $output = ltrim(shell_exec('octave --no-gui --quiet --eval "pkg load control;'. $command .'"'));
            $oparray = preg_split('/\s+/', trim($output));
            $finalString="";
            foreach ($oparray as $entry){
                $finalString =$finalString . $entry . " ";
            }
            

            break;
        case "getDataLietadlo":
            $lastR = $_GET['lastR'];
            $lastP = [];
            $r = $_GET['r'];
            $last = $_GET['last'];
            if ($last === '0')
                $lastP = [0,0,0];
            else {
                $lastArr = preg_split('/:/', $last);
                array_pop($lastArr);
                foreach ($lastArr as $lastPos) {
                    array_push($lastP, $lastPos);
                }
            }

            $command = "A = [-0.313 56.7 0; -0.0139 -0.426 0; 0 56.7 0];
                        B = [0.232; 0.0203; 0];
                        C = [0 0 1];
                        D = [0];
                        p = 2;
                        K = lqr(A,B,p*C'*C,1);
                        N = -inv(C(1,:)*inv(A-B*K)*B);
                        sys = ss(A-B*K, B*N, C, D);
                        
                        t = 0:0.1:40;
                        r = " . $r . ";                    
                        [y,t,x]=lsim(sys,r*ones(size(t)),t,[". implode(",", $lastP) ."]);

                        disp(x(:,3))
                        disp('endOfPos')
                        disp(r*ones(size(t))*N-x*K') 
                        disp('endOfAng')
                        disp(x(size(x,1),:))
                        ";

            $output = ltrim(shell_exec('octave --no-gui --quiet --eval "pkg load control;'. $command .'"'));
            $oparray = preg_split('/\s+/', trim($output));
            $finalString="";
            foreach ($oparray as $entry){
                $finalString = $finalString . $entry . " ";
            }
            $finalString = $finalString . "endOfLastP" . " " . $r . " " . $lastR;
            echo $finalString;
            break;

        case "getDataGulicka":
            $lastP = [];
            $r = $_GET['r'];
            $last = $_GET['last'];
            if ($last === '0')
                $lastP = [0,0,0,0];
            else {
                $lastArr = preg_split('/:/', $last);
                array_pop($lastArr);
                foreach ($lastArr as $lastPos) {
                    array_push($lastP, $lastPos);
                }
            }

            $command = "m = 0.111;
                        R = 0.015;
                        g = -9.8;
                        J = 9.99e-6;
                        H = -m*g/(J/(R^2)+m);
                        A = [0 1 0 0; 0 0 H 0; 0 0 0 1; 0 0 0 0];
                        B = [0;0;0;1];
                        C = [1 0 0 0];
                        D = [0];   
                        K = place(A,B,[-2+2i,-2-2i,-20,-80]);
                        N = -inv(C*inv(A-B*K)*B);
                        
                        sys = ss(A-B*K,B,C,D);
                        t = 0:0.01:5;
                        r = " . $r . ";  

                        [y,t,x]=lsim(N*sys,r*ones(size(t)),t,[". implode(",", $lastP) ."]);
                        disp(N*x(:,1))
                        disp('endOfPos')
                        disp(x(:,3)) 
                        disp('endOfAng')
                        disp(x(size(x,1),:))
                        ";

            $output = ltrim(shell_exec('octave --no-gui --quiet --eval "pkg load control;'. $command .'"'));
            $oparray = preg_split('/\s+/', trim($output));
            $finalString="";
            foreach ($oparray as $entry){
                $finalString =$finalString . $entry . " ";
            }
            echo $finalString;
            break;


    }
} elseif ($method == 'POST') {


//    echo json_encode($result);

} else {
    echo json_encode($result);

}