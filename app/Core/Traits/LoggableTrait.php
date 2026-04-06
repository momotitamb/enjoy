<?php

trait LoggableTrait {
    public function log(string $message): void {
        error_log(date('Y-m-d H:i:s') . ' ' . $message);
    }
}