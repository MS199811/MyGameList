<?php 

$menuArray = [
	'Platform' => [
		'Switch',
        'Playstation',
        'XBOX',
        'PC'
    ],
	'Genres' => [
		'Horror',
        'Action',
        'Adventure',
        'RPG',
        'Strategy',
        'Shooter',
        'Sports',
        'Fighting',
        'Racing',
        'Platform',
        'Puzzle'
    ]   
];

function createMenu(array $menuArray) {
    $html = '<ul>';
    foreach($menuArray as $subMenu => $subMenuContent) {
        $html .= '<li><button class="menuButton '.$subMenu.'">' . htmlspecialchars($subMenu) . '</button><ul><section>';
        foreach($subMenuContent as $item) {
            $html .= '<li><button class="button '.$item.'">' . htmlspecialchars($item) . '</button></li>';
        }
        $html .= '</section></ul></li>';
    }
    $html .= '</ul>';
    return $html;
}
?>

<nav>
    <?php echo createMenu($menuArray) ?>
</nav>

