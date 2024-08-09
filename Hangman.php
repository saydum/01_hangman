<?php
$words = ['apple', 'internet', 'football', 'moscow'];

/**
 * 1) Установить слово из словаря
 * 2) Вывести сообщение о вводе буквы, кол-во попыток, скрытые буквы в виде нижнего подчёркивания ___a__
 * 3) Вывести персонажа
 * 4) Полученную букву проверить если да то вывести и снова попросить ввод пока попытки не закончатся
 * 5) Если попытка закончится ожидаем две команды 0-close 1-restart
 */


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


