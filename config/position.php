<?php

return [
    /**
     * The default key to use when adding the position to each item 
     * in the collection. It could still be overridden when calling
     * method by passing a string as the second argument.
     */
    'key' => 'position',

    /**
     * Whether to show the total number of items in the collection
     * in the position text eg. 12th out of 30. It could still be overridden when calling
     * method by passing a boolean as the third argument.
     */
    'show_total' => false,

    /**
     * The text to join the position and the total number of items
     * in the collection
     */
    'join_text' => 'out of'
];