<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expression'])) {
    $expression = $_POST['expression'];
    
    // Удаляем пробелы и заменяем двойной минус на плюс
    $expression = str_replace(" ", "", $expression);
    $expression = str_replace("--", "+", $expression);
    
    // Проверяем на наличие тригонометрических функций
    $hasTrig = preg_match('/(sin|cos|tan)\(/i', $expression);
    
    if ($hasTrig) {
        // Для тригонометрических функций используем eval с проверкой
        if (!preg_match('/^[\d\+\-\*\/\(\)\.\s\w]+$/', $expression) || 
            (preg_match('/[a-z]+/i', $expression) && 
            !preg_match('/^(sin|cos|tan)\(/i', $expression))) {
            echo "Недопустимое выражение";
            exit;
        }
        
        try {
            $result = eval("return " . $expression . ";");
            if ($result === false && !is_numeric($result)) {
                echo "Ошибка в выражении";
            } else {
                echo $result;
            }
        } catch (Throwable $e) {
            echo "Ошибка вычисления";
        }
    } else {
        // Для обычных арифметических операций используем безопасный калькулятор
        if (!preg_match('/^[\d\+\-\*\/\(\)\.]+$/', $expression)) {
            echo "Недопустимое выражение";
            exit;
        }
        
        try {
            $result = calculateExpression($expression);
            echo $result;
        } catch (Exception $e) {
            echo "Ошибка вычисления";
        }
    }
    exit;
}

function calculateExpression($expr) {
    // Удаляем все пробелы
    $expr = preg_replace('/\s+/', '', $expr);
    
    // Сначала обрабатываем скобки (рекурсивно)
    while (strpos($expr, '(') !== false) {
        $expr = preg_replace_callback('/\(([^()]+)\)/', function($matches) {
            return calculateExpression($matches[1]);
        }, $expr);
    }
    
    // Разбиваем выражение на числа и операторы
    preg_match_all('/(-?\d*\.?\d+)|[\+\-\*\/]/', $expr, $matches);
    $tokens = $matches[0];
    
    // Сначала выполняем умножение и деление
    for ($i = 1; $i < count($tokens) - 1; $i += 2) {
        if ($tokens[$i] === '*' || $tokens[$i] === '/') {
            $left = floatval($tokens[$i - 1]);
            $right = floatval($tokens[$i + 1]);
            
            if ($tokens[$i] === '*') {
                $result = $left * $right;
            } else {
                if ($right == 0) {
                    throw new Exception("Деление на ноль");
                }
                $result = $left / $right;
            }
            
            $tokens[$i - 1] = $result;
            array_splice($tokens, $i, 2);
            $i -= 2;
        }
    }
    
    // Затем выполняем сложение и вычитание
    $result = floatval($tokens[0]);
    for ($i = 1; $i < count($tokens) - 1; $i += 2) {
        $operator = $tokens[$i];
        $operand = floatval($tokens[$i + 1]);
        
        if ($operator === '+') {
            $result += $operand;
        } else if ($operator === '-') {
            $result -= $operand;
        }
    }
    
    return $result;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Калькулятор</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="calculator">
        <input type="text" id="display" disabled />

        <div class="buttons">
            <div>
                <button onclick="appendTrig('sin')">sin</button>
                <button onclick="appendTrig('cos')">cos</button>
                <button onclick="appendTrig('tan')">tan</button>
                <button onclick="appendChar('.')">.</button>
            </div>
            <div>
                <button onclick="appendChar('1')">1</button>
                <button onclick="appendChar('2')">2</button>
                <button onclick="appendChar('3')">3</button>
                <button onclick="appendChar('*')">*</button>
            </div>
            <div>
                <button onclick="appendChar('4')">4</button>
                <button onclick="appendChar('5')">5</button>
                <button onclick="appendChar('6')">6</button>
                <button onclick="appendChar('-')">-</button>
            </div>
            <div>
                <button onclick="appendChar('7')">7</button>
                <button onclick="appendChar('8')">8</button>
                <button onclick="appendChar('9')">9</button>
                <button onclick="appendChar('+')">+</button>
            </div>
            <div>
                <button onclick="appendChar('(')">(</button>
                <button onclick="appendChar('0')">0</button>
                <button onclick="appendChar(')')">)</button>
                <button onclick="appendChar('/')">/</button>
            </div>
            <div>
                <button onclick="clearDisplay()">C</button>
                <button class="count" onclick="calculate()">Вычислить</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>