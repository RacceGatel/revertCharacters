<?php

function revertCharacters($str) {
    $word = [];
    $out = [];
    $array = mb_str_split($str);

    for($i=0; $i < count($array); $i++) {
        if(preg_match('/[А-Яа-яA-Za-z]/u', $array[$i])) {
            array_push($word, $array[$i]);
        } else {
            for($j=count($word)-1; $j >= 0; $j--) {
                if(preg_match('/[A-ZА-Я]/u', $array[$i-$j-1])) {
                    array_push($out, mb_strtoupper($word[$j]));
                } else
                    array_push($out, mb_strtolower($word[$j]));
            }
            array_push($out, $array[$i]);
            $word = [];
        }
    }

    return implode("", $out);
}

function revertCharacters_unit_test($input, $expected) {
    if(revertCharacters($input) == $expected)
        print_r("Unit-test: true");
    else
        print_r("Unit-test: false");
}

echo '#1 ';
revertCharacters_unit_test("Привет! Давно не виделись.", "Тевирп! Онвад ен ьсиледив.");
echo '</br>';
echo '#2 ';
revertCharacters_unit_test("Антон-Антонович, простите.", "Нотна-Чивонотна, етитсорп.");
echo '</br>';
echo '#3 ';
revertCharacters_unit_test("ЗдРавИя желАю.", "ЯиВарДз юалЕж.");
echo '</br>';