<?php

return [
    'nextActive' => '<li><a class="pagination-next" rel="next" href="{{url}}"><span aria-hidden="true">&raquo;</span></a></li>',
    'nextDisabled' => '<li><a class="pagination-next" href="" onclick="return false;" disabled><span aria-hidden="true">&raquo;</span></a></li>',
    'prevActive' => '<li class="page-item prev"><a rel="prev" class="pagination-link" href="{{url}}"><span aria-hidden="true">&laquo;</span></a></li>',
    'prevDisabled' => '<li class="page-item prev disabled"><a class="pagination-link" href="" onclick="return false;" disabled><span aria-hidden="true">&laquo;</span></a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="page-item first"><a class="pagination-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="page-item last"><a class="pagination-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="pagination-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="pagination-link" href="">{{text}}</a></li>',
    'ellipsis' => '<li><span class="pagination-ellipsis">&hellip;</span></li>',
    'sort' => '<a href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
    'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
];
