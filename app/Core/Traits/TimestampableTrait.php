<?php

trait TimestampableTrait {
    public function getCreatedAt(string $timestamp): string {
        return date('d.m.Y H:i', strtotime($timestamp));
    }
}