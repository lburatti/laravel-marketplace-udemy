<?php

function filterItemsByStoreId($items, $storeId) 
{
    return array_filter($items, function($line) use($storeId) {
        return $line['store_id'] == $storeId;
    });
}

function formatePriceToDatabase($price)
{
    // o que for '.' é retirado, o que for ',' vira '.'
    return str_replace(['.', ','], ['', '.'], $price);
}