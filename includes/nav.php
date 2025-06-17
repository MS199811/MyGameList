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
    $html = '<ul class="menu">';
    foreach($menuArray as $subMenu => $subMenuContent) {
        $html .= '<li class="menu-item">';
        $html .= '<button class="menuButton">' . htmlspecialchars($subMenu) . '</button>';
        $html .= '<ul class="submenu">';
        foreach($subMenuContent as $item) {
            $html .= '<li><button class="submenuButton '.strtolower(htmlspecialchars($item)).'">' . htmlspecialchars($item) . '</button></li>';
        }
        $html .= '</ul>';
        $html .= '</li>';
    }
    $html .= '</ul>';
    return $html;
}
?>

<nav>
    <?php echo createMenu($menuArray) ?>
</nav>

