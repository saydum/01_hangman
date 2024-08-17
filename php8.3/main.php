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

function renderUi(int $step): void
{
    $uiElements = [' ', '0', '/', '|', '\\', '/', '\\'];
    $ui = array_fill(0, count($uiElements), ' ');

    if ($step <= 6 && $step >= 0) {
        for ($i = 0; $i <= $step; $i++) {
            $ui[$i] = $uiElements[$i];
        }
    }

    $hangman = "
    ----------
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

function playGame(array $words, int $attemptsCount): void
{
    echo "--------------------------------------------------------" . PHP_EOL;
    echo "---------------   Hangman v0.0.1    --------------------" . PHP_EOL;
    echo "-------  You have {$attemptsCount} attempts to guess the word  -------" . PHP_EOL;
    echo "--------------------------------------------------------" . PHP_EOL;

    $word = setRandomWord($words);
    $stateWord = array_fill(0, strlen($word), ' _ ');

    renderUi(0);
    $step = 1;


    while (true) {
        echo "Word: " . implode('', $stateWord) . PHP_EOL;
        echo "Attempts: {$attemptsCount}" . PHP_EOL;

        $letter = readline("Enter letter...");
        if (strlen($letter) > 1) break;

        if (checkLetterInWord($letter, $word)) {
            updateStateWord($letter, $word, $stateWord);

            if (checkFinish($word, $stateWord)) break;
        } else {
            $attemptsCount--;
            renderUi($step);
            $step++;
            if ($attemptsCount === 0) {
                echo '🤖 Game Over 🤖';
                break;
            }
        }
    }

}

playGame(['moscow', 'apple'], 10);