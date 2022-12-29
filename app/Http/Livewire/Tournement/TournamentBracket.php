<?php

namespace App\Http\Livewire\Tournement;

use Livewire\Component;

class TournamentBracket extends Component
{

    public array $ArrayPlayer = ['léo','adrien','gaël','cyril','zac','florian','thomas','pierre'];
    public $nodesTotal;
    public array $JsonBracket;
    public array $paramBracket ;


    public array $arrayNodeStart = [];



    public function mount()
    {
//        $nodes = count($this->ArrayPlayer);
//        $this->nodesTotal = (($nodes/2)+($nodes%2))*2-1;
//
//        shuffle($this->ArrayPlayer);
//        for ($i=0;$i< count($this->ArrayPlayer);$i+=2)
//        {
//                array_push($this->arrayNodeStart,$this->ArrayPlayer[$i].'/'.$this->ArrayPlayer[$i+1]);
//        }
//
        $this->generateTree();

    }


    private function  generateTree()
    {

//                $array1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16];
//                $array1 = [1,2,3,4,5,6,7,8,9,10,11,12];
                $array1 = [1,2,3,4,5,6];
//        $array1 = ['léo','adrien','gaël','cyril','zac','florian','thomas','pierre'];

        $arrayReturned = $this->recurciveTreeArray([],count($array1)*2,0 );



        $hiddenCard = [];
        foreach ($arrayReturned as $key => $value)
        {
            if(gettype($value) === "string")
            {
                $hiddenCard[$key+1] = intval($value);
                $arrayReturned[$key] = intval($value);
            }
        }


        $result = [];
        $count = 1;
//        foreach (array_reverse($arrayReturned) as $data)
        foreach ($arrayReturned as $data)
        {
            $result[$count] = $data;
            $count++;
        }
        dump($arrayReturned);

       $newMultiArray[count($result)+1] = $this->CreateJsonTreeFromArray($result,count($result)+1);
       $arrayParam = [];

       for ($i=0;$i< count($result)+1;$i++)
       {
           $arrayParam[$i+1] = [];
           $arrayParam[$i+1]['trad'] = $i+1;
           $arrayParam[$i+1]['color']='#6c5544';
           if(array_key_exists($i,$array1))
           {
               $arrayParam[$i+1]['trad'] = $array1[$i];
           }
//           if(array_key_exists($i,$hiddenCard))
//           {
//               dump($i);
//               $arrayParam[$i]['hidden'] = $hiddenCard[$i];
//           }
       }
       foreach ($hiddenCard as $key => $value)
       {
           dump('value => ' .$value);
           $arrayParam[$value]['hidden'] = $value;
       }

        $this->JsonBracket = $newMultiArray;
       $this->paramBracket =$arrayParam;
//       dd(json_encode($newMultiArray));
//        dd($newMultiArray);
    }

    public function CreateJsonTreeFromArray(array $Currentarray,int $currentKey):array
    {
        $someArray =[];
        foreach ($Currentarray as $key => $value) {
            if ($value === $currentKey)
            {
                $currentArray = $this->CreateJsonTreeFromArray($Currentarray,$key);
                if(empty($currentArray))
                {
                    $someArray[$key]= '';
                }
                else{
                    $someArray[$key] =  $currentArray;
                }
            }
        }
            return $someArray;
    }



    private function recurciveTreeArray(array $arrayParam,int $previousSize,int $totalCount,int $deep = 0,$retenu = 0 ,int $deepLimit =10) :array
    {
        dump('------------------ITERATE--------------------');
        $deep += 1;
        $multiplicateur = $previousSize === ceil(($previousSize/2)?2:1);
        $previousSize += $retenu*2;
        dump('MODULO ' .$previousSize .'/2 = '.($previousSize/2).' =' .  ($previousSize/2) % 2 );

        $length = (int)ceil(($previousSize/2));
        $retenu = 0;
        if(floor($previousSize/2) % 2 !== 0)
        {
            dump('Retenue');
            $length = (int)ceil($previousSize/2)-1;
            $retenu = 1;
        }

        $is_retenu = ($retenu !== 0? 1:0);

        //securité de recurcivité infini
        if($deep < $deepLimit & $length > 1)
        {
            $count = 0;
            $arrayParam;
            $totalCount += $length +$is_retenu ;
            dump('$totalCount = ' .$totalCount);
            dump('$length = ' .$length);

            for($i=0;$i< $length ;$i+=2)
            {
                dump( $i +1 . ' = ' .$totalCount+1+$count);
                dump( $i +2 . ' = ' .$totalCount+1+$count);
                array_push($arrayParam,($totalCount+1+$count));
                array_push($arrayParam,($totalCount+1+$count));
                $count+=1;
            }

            if($is_retenu !== 0 )
            {
                dump( '$retenu ='. $retenu);
                dump( $i+1 . ' = ' .$totalCount+1+$count);
                array_push($arrayParam, strval($totalCount+1+$count));
                $is_retenu = 0;

            }
            dump('end length = '. $length);
            return $this->recurciveTreeArray( $arrayParam,$length,$totalCount,$deep,$retenu);
        }
        return $arrayParam;
    }

    public function render()
    {
        return view('livewire.tournement.tournament-bracket');
    }
}
