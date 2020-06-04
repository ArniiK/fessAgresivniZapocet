<?php
session_start();
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
//            $cmd = "octave -qf --eval 'printf (\"%f\", " . $_GET['r'] . ");'";
//            $output = exec ($cmd);
//            var_dump ($output);




            break;
        case "getDataKyvadlo":
            $r = $_GET['r'];


            $lastP = [0,0,0,0];

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
                        ";

            $output = ltrim(shell_exec('octave --no-gui --quiet --eval "pkg load control;'. $command .'"'));
            $parts = preg_split('/\s+/', $output);

//           var_dump($parts);
            $pos=true;
            $positions=[];
            $angles=[];
            $i=0;

            foreach ($parts as $part){
                if($part==="endOfPos"){
                    $pos=false;
                    $i=0;
                    continue;
                }
                if ($pos){
                    array_push($positions,doubleval($part));
                    array_push($datapoints1,array("x" => $i, "y"=>doubleval($part)));

                }else{
                    array_push($angles,doubleval($part));
                    array_push($datapoints2,array("x" => $i, "y"=>doubleval($part)));
                }
                $i++;
            }
            array_pop($angles);
            echo "kyvadlo";
//            var_dump($parts);
//            var_dump($positions);

            $_SESSION['pos']= $positions;

            $_SESSION['ang']= $angles;





            break;
        case "getDataTlmic":
            $r = $_GET['r'];


            $lastP = [0,0,0,0];

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
                        initX1=0;
                        initX1d=0;
                        initX2=0;
                        initX2d=0;
                        [y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d;0]);
                        disp(x(:,1))
                        disp('endOfPos')
                        disp(x(:,3)) 
                        ";

            $output = ltrim(shell_exec('octave --no-gui --quiet --eval "pkg load control;'. $command .'"'));
            $parts = preg_split('/\s+/', $output);

//           var_dump($parts);
            $pos=true;
            $positions=[];
            $angles=[];
            $i=0;

            foreach ($parts as $part){
                if($part==="endOfPos"){
                    $pos=false;
                    $i=0;
                    continue;
                }
                if ($pos){
                    array_push($positions,doubleval($part));
                    //array_push($datapoints1,array("x" => $i, "y"=>doubleval($part)));

                }else{
                    array_push($angles,doubleval($part));
                    //array_push($datapoints2,array("x" => $i, "y"=>doubleval($part)));
                }
                $i++;
            }
            array_pop($angles);
            var_dump($angles);
            var_dump($positions);


            $_SESSION['pos']= $positions;

            $_SESSION['ang']= $angles;


            break;

    }
} elseif ($method == 'POST') {


//    echo json_encode($result);

} else {
    echo json_encode($result);

}