<?php

/**
 * 1) Установить слово из словаря
 * 2) Вывести сообщение о вводе буквы, кол-во попыток, скрытые буквы в виде нижнего подчёркивания ___a__
 * 3) Вывести персонажа
 * 4) Полученную букву проверить если да то вывести и снова попросить ввод пока попытки не закончатся
 * 5) Если попытка закончится ожидаем две команды 0-close 1-restart
 */

// Словарь
$words = include './words.php';

// Кол-во попыток
$count = 6;

// UI Элементы
$ui = [
    'O ', // 0
    '|',  // 1
    '/',  // 2
    "\\", // 3
];


function setRandWord(array $words): string
{
    return $words[rand(0, count($words) - 1)];
}

function hiddenAndShowLetter(string $word, string $letter): string
{
    $stateWord = [];

    $i = 0;
    foreach (str_split($word) as $w) {
        if ($w === $letter) {
            $stateWord[$i] = $letter;
        } else {
            $stateWord[$i] = ' _ ';
        }
        $i++;
    }

    return implode('', $stateWord);
}

function showUiElementsBySteps(
    string $step1 = ' ',
    string $step2 = ' ',
    string $step3 = ' ',
    string $step4 = ' ',
    string $step5 = ' ',
    string $step6 = ' '
): void
{
    $format = "
        ----------
           |     |
           %s    |
          %s%s%s    |
          %s %s    |
                 |
    --------------
    ";

    echo sprintf(
        $format,
        $step1,
        $step2,
        $step3,
        $step4,
        $step5,
        $step6,
    );
}


// По шагово с условием
//$step1 = $ui[0];
//$step2 = $ui[2];
//$step3 = $ui[1];
//$step4 = $ui[3];
//$step5 = $ui[2];
//$step6 = $ui[3];
//showUiElementsBySteps($step1, $step2, $step3, $step4, $step5, $step6);

function inputLetterUser(): string
{
    $input = readline();

    if (strlen($input) > 1) return 'error: max letter 1.';

    return $input;
}

