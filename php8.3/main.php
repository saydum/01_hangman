<?php
function setRandomWord(array $words): string
{
    return $words[array_rand($words)];
}

function checkLetterInWord(string $letter, string $word): bool
{
    if (in_array($letter, str_split($word))) return true;
    return false;
}

function updateStateWord(string $letter, string $word, array &$stateWord): void
{
    foreach (str_split($word) as $index => $let) {
        if ($let === $letter) $stateWord[$index] = $letter;
    }
}

function createFilledArray(int $length, string $value): array
{
    return array_fill(0, $length, $value);
}

function renderUi(int $step): void
{
    $uiElements = [' ', '0', '/', '|', '\\', '/', '\\'];
    $ui = createFilledArray(count($uiElements), ' ');

    if ($step <= 6 && $step >= 0) {
        for ($i = 0; $i <= $step; $i++) {
            $ui[$i] = $uiElements[$i];
        }
    }

    $hangman = "
    --------------
           |     |
           {$ui[1]}     |
          {$ui[2]}{$ui[3]}{$ui[4]}    |
          {$ui[5]} {$ui[6]}    |
                 |
    --------------
    ";
    echo $hangman;
}

function checkFinish(string $word, array $stateWord): bool
{
    if ($word === implode('', $stateWord)) {
        return true;
    }
    return false;
}

function validateReadlineLetter(string $letter): bool
{
    return strlen($letter) !== 1;
}

function displayGameState(array &$stateWord, int $attemptsCount): void
{
    echo "Word: " . implode('', $stateWord) . PHP_EOL;
    echo "Attempts: {$attemptsCount}" . PHP_EOL;
}

function handleCorrectLetter(string $letter, string $word, array &$stateWord): bool
{
    updateStateWord($letter, $word, $stateWord);
    return checkFinish($word, $stateWord);
}

function handleIncorrectLetter(int &$attemptsCount, int &$step): void
{
    $attemptsCount--;
    renderUi($step);
    $step++;

    if ($attemptsCount === 0) echo '🤖 Game Over 🤖';
}

function welcome(int $attemptsCount): void
{
    echo "--------------------------------------------------------" . PHP_EOL;
    echo "---------------   Hangman v0.0.1    --------------------" . PHP_EOL;
    echo "-------  You have {$attemptsCount} attempts to guess the word  -------" . PHP_EOL;
    echo "--------------------------------------------------------" . PHP_EOL;
}

function gameLoop(array &$stateWord, int $attemptsCount, string $word, int $step): void
{
    while (true) {
        displayGameState($stateWord, $attemptsCount);
        $letter = readline("Enter letter...");

        if (!validateReadlineLetter($letter)) {
            if (checkLetterInWord($letter, $word)) {
                if (handleCorrectLetter($letter, $word, $stateWord)) break;
            } else {
                handleIncorrectLetter($attemptsCount, $step);
                if ($attemptsCount === 0) break;
            }
        } else {
            echo "Please enter a single letter." . PHP_EOL;
        }
    }
}

function playGame(array $words): void
{
    // Устанавливаем рандомно новое слово
    $word = setRandomWord($words);

    // Устанавливаем попытки по длине слово
    $attemptsCount = strlen($word) + 3;
    
    // Вывод приветствия
    welcome($attemptsCount);

    // Инициализируем слово в виде массива чтобы в себе хранить состояние угадываемого слова
    $stateWord = createFilledArray(strlen($word), ' _ ');

    // Инициализируем вывод виселицы
    renderUi(0);
    // По шагам вырисовывается виселицу
    $step = 1;

    // Запускаем игровой цикл
    gameLoop($stateWord, $attemptsCount, $word, $step);
}

playGame(['moscow', 'apple']);