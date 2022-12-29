<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div id="my_tree"></div>
    <script>

        let tree = {{Js::from($JsonBracket)}};
        // let tree = {
        //     "31":{
        //         "29":{
        //             "25":{
        //                 "17":{
        //                     "1":"",
        //                     "2":""
        //                 },
        //                 "18":{
        //                     "3":"",
        //                     "4":""
        //                 }
        //             },
        //             "26":{
        //                 "19":{
        //                     "5":"",
        //                     "6":""
        //                 },
        //                 "20":{
        //                     "7":"",
        //                     "8":""
        //                 }
        //             }
        //         },
        //         "30":{
        //             "27":{
        //                 "21":{
        //                     "9":"",
        //                     "10":""
        //                 },
        //                 "22":{
        //                     "11":"",
        //                     "12":""
        //                 }
        //             },
        //             "28":{
        //                 "23":{
        //                     "13":"",
        //                     "14":""
        //                 },
        //                 "24": {
        //                     "60":{}
        //                 },
        //             }
        //         }
        //     }
        // };
        let params = {{Js::from($paramBracket)}};
        // let params = {
        //     1: {trad: 'adrien / leo'},
        //     2: {trad: 'Card 2',color:'#6c5544'},
        //     3: {trad: 'Card 3'},
        //     4: {trad: 'Card 4',color:'#6c5544'},
        //     5: {trad: 'Card 5',color:'#13c200'},
        //     6: {trad: 'Card 6'},
        //     7: {trad: 'Card 7'},
        //     31:{trad: 'final'},
        // };
    </script>
</div>
