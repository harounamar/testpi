<?php
$jsonData = json_decode(file_get_contents('esprit.json'), true);

foreach ($jsonData as $tableName => $columns) {
    $className = ucfirst($tableName);

    $entityCode = "<?php\n\nnamespace App\\Entity;\n\nuse Doctrine\\ORM\\Mapping as ORM;\n\n";
    $entityCode .= "/**\n * @ORM\\Entity()\n * @ORM\\Table(name=\"$tableName\")\n */\n";
    $entityCode .= "class $className\n{\n";

    foreach ($columns as $columnName => $columnType) {
        $doctrineType = match ($columnType) {
            'int' => 'integer',
            'bigint' => 'bigint',
            'string' => 'string',
            'text' => 'text',
            'datetime' => 'datetime',
            'datetime_immutable' => 'datetime_immutable',
            default => 'string'
        };

        $entityCode .= "    /**\n     * @ORM\\Column(type=\"$doctrineType\")\n     */\n";
        $entityCode .= "    private $$columnName;\n\n";
    }

    $entityCode .= "}\n";

    file_put_contents("src/Entity/$className.php", $entityCode);
}
?>
