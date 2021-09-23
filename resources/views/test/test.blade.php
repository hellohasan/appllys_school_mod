<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        .tree {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #fbfbfb;
            border: 1px solid #999;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)
        }

        .tree li {
            list-style-type: none;
            margin: 0;
            padding: 10px 5px 0 5px;
            position: relative
        }

        .tree li::before, .tree li::after {
            content: '';
            left: -20px;
            position: absolute;
            right: auto
        }

        .tree li::before {
            border-left: 1px solid #999;
            bottom: 50px;
            height: 100%;
            top: 0;
            width: 1px
        }

        .tree li::after {
            border-top: 1px solid #999;
            height: 20px;
            top: 25px;
            width: 25px
        }

        .tree li span:not(.glyphicon) {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            display: inline-block;
            padding: 4px 9px;
            text-decoration: none
        }

        .tree li.parent_li > span:not(.glyphicon) {
            cursor: pointer
        }

        .tree > ul > li::before, .tree > ul > li::after {
            border: 0
        }

        .tree li:last-child::before {
            height: 30px
        }

        .tree li.parent_li > span:not(.glyphicon):hover, .tree li.parent_li > span:not(.glyphicon):hover + ul li span:not(.glyphicon) {
            background: #eee;
            border: 1px solid #999;
            padding: 3px 8px;
            color: #000
        }
    </style>
</head>
<body>
<div id="test" class="tree">
    <ul>
        <li class="parent_li"><span title="Verkleinern">Department</span>
            <ul>
                <li class="parent_li"><span title="Verkleinern">Science</span>
                    <ul>
                        <li class="parent_li"><span title="Verkleinern">A</span></li>
                        <li class="parent_li"><span title="Verkleinern">B</span></li>
                        <li class="parent_li"><span title="Verkleinern">C</span></li>
                    </ul>
                </li>
                <li class="parent_li"><span title="Verkleinern">Commerce</span>
                    <ul>
                        <li class="parent_li"><span title="Verkleinern">Section</span>
                            <ul>
                                <li class="parent_li"><span title="Verkleinern">S</span></li>
                                <li class="parent_li"><span title="Verkleinern">B</span></li>
                                <li class="parent_li"><span title="Verkleinern">C</span></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="parent_li"><span title="Verkleinern">Arts</span>
                    <ul>
                        <li class="parent_li"><span title="Verkleinern">A</span></li>
                        <li class="parent_li"><span title="Verkleinern">B</span></li>
                        <li class="parent_li"><span title="Verkleinern">C</span></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>
</body>
</html>


<!------ Include the above in your HEAD tag ---------->

