<?php

return [
    'nextActive' => '<li class="page-item next"><a class="page-link" rel="next" href="{{url}}"><span aria-hidden="true">&raquo;</span></a></li>',
    'nextDisabled' => '<li class="page-item next disabled"><a class="page-link" href="" onclick="return false;"><span aria-hidden="true">&raquo;</span></a></li>',
    'prevActive' => '<li class="page-item prev"><a rel="prev" class="page-link" href="{{url}}"><span aria-hidden="true">&laquo;</span></a></li>',
    'prevDisabled' => '<li class="page-item prev disabled"><a class="page-link" href="" onclick="return false;"><span aria-hidden="true">&laquo;</span></a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="page-item first"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="page-item last"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
    'ellipsis' => '<li class="page-item ellipsis">&hellip;</li>',
    'sort' => '<a href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
    'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
];
