<?php

interface Sluggable {    
    public function generateSlug(string $text): string;
}