# 01 Hangman php
Задача из `Java Роадмап Сергея Жукова` \
https://zhukovsd.github.io/java-backend-learning-course/projects/hangman/
---

## Игровые шаги
1. Приветствие пользователя.
2. Установить случайное слово.
3. Вывести слово в скрытом виде `_ _ _ _ _`
4. Игровой цикл
    - Получить букву от пользователя (буквы не должны быть, не более двух).
    - Проверить есть ли введенная буква в установленной слове
        - `ДА` - Выводим букву в `stateWord()`
        - `НЕТ` - Уменьшит количество попыток, обновить вывод `виселицы`
        - Если кол-во попыток равно 0, то завершить игру.

## Функции игры
- `setRandomWord(array $words): string`: Принимает массив и возвращает случайное слово.
- `checkLetterInWord(string $letter, string $word): bool`: Проверяет есть ли буква в слове.
- `updateStateWord(string $letter, string $word, array &$stateWord): void`: Обновляет состояние скрытого слова который
  функция принимает по ссылке что-бы сохранить состояние самого слова.
- `renderUi(int $step): void`: Рисует и выводит виселицу по степенно.
- `checkFinish(string $word, array $stateWord): bool`: Проверяет не угаданная ли слово полностью.
- `playGame(array $words, int $attemptsCount): void`: Запускает игру, выводить куча сообщений проверяет условии и т. д.

## Запуск
```bash
git clone <repo> hangman
cd hangman/php8.3
php main.php
```

## images
|                                                                   |                                                                   |                                                                   |
|-------------------------------------------------------------------|-------------------------------------------------------------------|-------------------------------------------------------------------|
| ![](https://github.com/saydum/01_hangman/blob/main/state/sc1.png) | ![](https://github.com/saydum/01_hangman/blob/main/state/sc2.png) | ![](https://github.com/saydum/01_hangman/blob/main/state/sc3.png) |