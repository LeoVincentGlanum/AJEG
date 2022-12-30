<?php

namespace  Core\TreeGenerator;

class BracketTournament
{

    public array $JsonBracket;
    public array $paramBracket ;
     function __construct(array $ArrayParticipant)
     {
         $countParticipant = count($ArrayParticipant);
         $arrayReturned = $this->recurciveTreeArray([],$countParticipant,$countParticipant);

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

         foreach ($arrayReturned as $data)
         {
             $result[$count] = $data;
             $count++;
         }

         $newMultiArray[count($result)+1] = $this->FormatTreeArray($result,count($result)+1);
         $arrayParam = [];

         for ($i=0;$i< count($result)+1;$i++)
         {
             $arrayParam[$i+1] = [];
             $arrayParam[$i+1]['trad'] = $i+1;
             $arrayParam[$i+1]['color']='#6c5544';
             if(array_key_exists($i,$ArrayParticipant))
             {
                 $arrayParam[$i+1]['trad'] = $ArrayParticipant[$i];
             }
         }
         foreach ($hiddenCard as $key => $value)
         {
             $arrayParam[$value]['hidden'] = $value;
         }

         $this->JsonBracket = $newMultiArray;
         $this->paramBracket =$arrayParam;
     }

    public function FormatTreeArray(array $Currentarray,int $currentKey):array
    {
        $someArray =[];
        foreach ($Currentarray as $key => $value) {
            if ($value === $currentKey)
            {
                $currentArray = $this->FormatTreeArray($Currentarray,$key);
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

    public function prem1(int $value)
    {
        if($value <= 1) return false;
        for($i = 2 ; $i < $value;$i++)
        {
            if($value % $i === 0)
            {
                return  false;
            }
        }
        return true;
    }

    public function calculPairImpair(int $value , int $deep)
    {
        $arrayResult=[];
        if(!array_key_exists('double',$arrayResult))
        {
            $arrayResult['double'] = 0;
        }
        if(!array_key_exists('triple',$arrayResult))
        {
            $arrayResult['triple'] = 0;
        }
        $reste3 = $value%3;

        $reste2 = $value%2;

        $resultdeep = $deep%2;


        $premNumber = [
            7=>1,
            11=>1,
            13=>3,
            17=>3,
            19=>5
        ];

        if(array_key_exists($value,$premNumber))
        {
            $nombreIteration3 = $premNumber[$value];
            $nombreIteration2 = ($value - ($nombreIteration3*3))/2;
            $arrayResult['triple'] = $nombreIteration3;
            $arrayResult['double'] = $nombreIteration2;

            return $arrayResult;
        }
        if($resultdeep === 0 && $reste2 === 0 && $reste3 === 0)
        {
            $arrayResult['double'] = $value/2;
            return $arrayResult;
        }

        if($reste2 === 0 && $reste3 !== 0)
        {
            $arrayResult['double'] = $value/2;
            return $arrayResult;
        }
        $nombreIteration3 = ($value-$reste3)/3;
        $nombreIteration2 = ($value - ($nombreIteration3*3))/2;

        $arrayResult['triple'] = $nombreIteration3;
        $arrayResult['double'] = $nombreIteration2;

        return $arrayResult;
    }

    private function recurciveTreeArray(array $arrayParam,int $length,int $totalCount,int $deep = 0,int $deepLimit =5) :array
    {
        $deep += 1;
        $arrayStep =  $this->calculPairImpair($length , $deep);

        if($deep < $deepLimit && $length >1)
        {
            $count = 0;

            for($i=0;$i< $arrayStep['triple'] ;$i++)
            {
                array_push($arrayParam,($totalCount+$count+1));
                array_push($arrayParam,($totalCount+$count+1));
                $count+=1;
                array_push($arrayParam,strval($totalCount+$count+1));
                $count+=1;
            }
            for($i=0;$i< $arrayStep['double'] ;$i++)
            {
                array_push($arrayParam,($totalCount+$count+1));
                array_push($arrayParam,($totalCount+$count+1));
                $count+=1;
            }
            return $this->recurciveTreeArray( $arrayParam,$count,$totalCount +$count,$deep);
        }
        return $arrayParam;
    }



}
