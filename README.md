# Neural Inspire
Начну, пожалуй, с того, что данный проект вообще больше задумывался как прокачка скиллухи в базовых нейросетях и никакой смысловой нагрузки не несёт.

### Дайте мне сначала пример!
Конечно, [куда ж без этого.](http://clashbyte.ru/inspire)
![Цитатка дня](http://clashbyte.ru/inspire/img)

### Что это такое?
Как было упомянуто выше, это простая нейросеть, которая выдаёт по запросу совершенно несуразную, бессмысленную и приправленную крепкой порцией идиотизма цитатку. Для того, чтобы это работало, была произведена выборка семи с лишним тысяч сообщений одного из величайших специалистов в Java-отрасли, все сообщения были проанализированы и преобразованы в древовидные зависимости. Далее, благодаря богам, которые сидят за функцией `rand()`, алгоритм проходит по ветвям слов и собирает из них предложение. Всё достаточно просто, не правда ли?

# Как пользоваться?
Сервис предоставляет целых три вида выдачи информации, все они доступны по определенному ключу:
* **(без ключа)** - стандартный вывод. Будет показана страница с вдохновляющей цитатой;
* **(/api)** - вывод в виде JSON. Запилен по многочисленным просьбам, выдаёт в отдельных полях саму цитату и подпись автора;
* **(/img)** - вывод в виде картинки. Удобно, например, для вставки в подпись на форумах.

## Почему две папки с одинаковыми файлами?
Изначально, первая версия генератора была достаточно сырой и выдавала скорее набор слов, чем осмысленную цитату *(тот факт, что это совершенно не меняло смысл и очень походило на человека, чьи сообщения были анализированы, мы опустим)*. Позже был добавлен новый генератор и переанализированная база, однако, если всё-таки хочется опробировать старый, можно добавить в строку браузера ключ **?old**.

### Старый генератор
Если рассказать вкратце, то старая база представляла собой просто список слов. У каждого слова имелось поле со значением веса - количество раз, когда это слово стояло в начале предложения, следовательно, шанс того, что цитата начнётся именно с него. В корневом же объекте имелось поле, содержавшее сумму весов всех слов базы - именно до этого предела генерируется случайное число. Далее, слова выстраивались друг за другом, в одну большую ленту, в которой у каждого слова имелся свой участок определенной длины, после чего определялось, в чей промежуток попало случайное значение. Выбранное слово добавлялось к цитате, после чего просматривается список детей. В этом списке сохранены дочерние слова, которые хотя бы раз встречались после этого слова, а так же вес каждого (опять так же, сколько раз это дочернее слово встречалось после текущего). Алгоритм повторяется до тех пор, пока не будет достигнуто слово без дочерних слов, после чего к цитате пафосно приклеивается точка.

### Новый генератор
Если в старом генераторе все слова лежали одним большим списком, то в новой версии данные представлены в виде дерева: вместо того, чтобы хранить индексы встреченных дочерних слов, хранятся такие же слова, а в их дочерних списках лежат те слова, которые уже были после этих двух, и так далее. Это существенно повышает осмысленность цитат, но, в свою очередь, иногда может выдавать почти дословные цитаты из исходных сообщений. Во всём остальном, касательно выборки данных, разницы нет - слова выбираются по тому же "ленточному" алгоритму.
