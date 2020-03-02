<?php

/**
 * Выполняет редирект
 * 
 * @param string $uri - адрес перехода
 */
function redirect(string $uri) {
    header(sprintf('Location: %s', $uri));
    exit();
}
