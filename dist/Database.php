<?php ${"GL\x4f\x42AL\x53"}["j\x6a\x79i\x78\x6ft"]="r\x65\x73\x75\x6c\x74";${"\x47L\x4f\x42\x41\x4c\x53"}["o\x62\x6e\x70\x69\x6dpe"]="\x73\x71l";${"\x47\x4c\x4f\x42\x41LS"}["o\x71\x70\x77\x6a\x75\x76\x66\x74\x70m\x78"]="tip\x6f\x73q\x6c";${"\x47L\x4f\x42\x41L\x53"}["rq\x6ct\x73kx"]="db";${"\x47\x4c\x4f\x42\x41\x4cS"}["kdm\x78\x78sf"]="c\x6f\x6eex\x61o";class Database{private static$conexao=null;public function __construct(){}public static function Conectar(){self::${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x6b\x64m\x78\x78\x73\x66"]}=mysqli_connect("\x6cocal\x68os\x74","ro\x6ft","");}public static function SelectDB($db){$qvbzuqrob="\x63o\x6ee\x78\x61o";$vcymmbsa="\x63o\x6eexa\x6f";if(isset(self::${$qvbzuqrob}))mysqli_select_db(self::${$vcymmbsa},${${"\x47L\x4f\x42AL\x53"}["r\x71l\x74\x73\x6bx"]});}public static function Desconectar(){$kpyfowbfpdt="\x63o\x6e\x65\x78\x61o";if(isset(self::${$kpyfowbfpdt}))mysqli_close(self::${${"G\x4c\x4f\x42\x41L\x53"}["\x6b\x64m\x78\x78\x73\x66"]});self::${${"\x47\x4cO\x42AL\x53"}["\x6bd\x6d\x78\x78s\x66"]}=null;}public static function Executar($sql,$tiposql){try{self::Conectar();${"GL\x4f\x42\x41LS"}["j\x72\x76\x66u\x6b\x65\x70\x78s\x63\x75"]="\x63o\x6ee\x78\x61\x6f";$hqyqormgu="\x63\x6f\x6e\x65xa\x6f";$votgfrdm="qu\x65\x72\x79";$iowwptxqesm="\x71\x75e\x72y";${"\x47\x4c\x4fB\x41L\x53"}["\x6c\x6f\x62w\x6c\x76\x75k"]="\x63\x6f\x6ee\x78\x61\x6f";$kmyeqlnoyf="\x72\x65\x73\x75\x6c\x74";self::SelectDB("b\x61s\x65");${"G\x4c\x4fB\x41L\x53"}["\x68\x66il\x70\x76\x6e\x65\x6a\x72"]="r";${${"\x47\x4cO\x42\x41L\x53"}["\x6b\x64\x6dx\x78s\x66"]}=self::${${"GL\x4fBAL\x53"}["\x6arv\x66uke\x70\x78\x73\x63\x75"]};switch(${${"\x47\x4c\x4fB\x41L\x53"}["\x6f\x71\x70w\x6a\x75\x76\x66\x74p\x6dx"]}){case 0:case 1:case 2:mysqli_query(${$hqyqormgu},${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x6fb\x6e\x70\x69m\x70e"]});break;case 3:${$kmyeqlnoyf}=Array();${$votgfrdm}=mysqli_query(${${"G\x4c\x4f\x42\x41\x4cS"}["l\x6fb\x77\x6c\x76\x75k"]},${${"G\x4c\x4f\x42\x41\x4c\x53"}["\x6f\x62\x6e\x70i\x6dp\x65"]});while(${${"\x47LO\x42\x41\x4cS"}["hf\x69\x6cp\x76\x6e\x65j\x72"]}=mysqli_fetch_array(${$iowwptxqesm})){${"\x47L\x4fB\x41\x4c\x53"}["\x6er\x62\x6c\x68h\x70\x72\x66d"]="r";${${"\x47\x4c\x4fB\x41\x4cS"}["\x6ajy\x69\x78\x6f\x74"]}[]=${${"\x47LO\x42A\x4cS"}["\x6er\x62\x6chh\x70r\x66d"]};}return${${"\x47L\x4fB\x41\x4cS"}["j\x6a\x79\x69\x78\x6f\x74"]};break;}self::Desconectar();}catch(Exception$e){${"\x47\x4c\x4fBA\x4cS"}["\x70chyf\x73dho\x6a"]="\x65";throw${${"G\x4c\x4f\x42A\x4c\x53"}["\x70\x63hy\x66\x73\x64\x68\x6f\x6a"]};}}}
?>