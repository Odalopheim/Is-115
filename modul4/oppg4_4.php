<?php
$prosjekter = [
    [
        'navn' => 'Chatbot-prosjekt',
        'status' => 'Pågår',
        'ansvarlig' => 'Oda Lunde og Sara Stray',
        'deadline' => '2025-12-01'
    ]
];
?>

<table border="1" cellpadding="5">
    <tr>
        <th>Prosjektnavn</th>
        <th>Status</th>
        <th>Ansvarlig</th>
        <th>Deadline</th>
    </tr>
    <?php foreach ($prosjekter as $prosjekt): ?>
        <tr>
            <td><?= htmlspecialchars($prosjekt['navn']) ?></td>
            <td><?= htmlspecialchars($prosjekt['status']) ?></td>
            <td><?= htmlspecialchars($prosjekt['ansvarlig']) ?></td>
            <td><?= htmlspecialchars($prosjekt['deadline']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>