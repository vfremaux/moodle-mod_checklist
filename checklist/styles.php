ol.checklist li {
    list-style-type: none;
}

ol.checklist .useritem {
    font-style: italic;
    color: #404090;
}

ol.checklist .note {
    font-style: italic;
    color: #a0a0e0;
    padding: 0 0 0 20px;
}

ol.checklist .itemoptional {
    font-style: italic;
}

ol.checklist .itemheading {
    font-weight: bold;
}

ol.checklist .itemblack {
    color: #000000;
}

ol.checklist .itemblack.itemoptional {
    color: #a0a0a0;
}

ol.checklist .itemred {
    color: #ff0000;
}

ol.checklist .itemred.itemoptional {
    color: #ffa0a0;
}

ol.checklist .itemorange {
    color: #ffba00;
}

ol.checklist .itemorange.itemoptional {
    color: #ffdaa0;
}

ol.checklist .itemgreen {
    color: #00ff00;
}

ol.checklist .itemgreen.itemoptional {
    color: #a0ffa0;
}

ol.checklist .itempurple {
    color: #d000ff;
}

ol.checklist .itempurple.itemoptional {
    color: #d0a0ff;
}

ol.checklist .teachercomment {
    color: black;
    background-color: #ffffb0;
    border: solid black 1px;
    margin: 0 0 0 20px;
}

ol.checklist .itemauto.itemdisabled {
    text-decoration: line-through;
    background-color: #bcc4c4;
}

ol.checklist .itemauto {
    background-color: #d6e6e7;
}

ol.checklist li .itemuserdate {
    background-color: #b0ffb0;
    position: absolute;
    width: 10em;
    left: 75%;
    zindex: 100;
}

ol.checklist li .itemteacherdate {
    background-color: #b0ffb0;
    position: absolute;
    width: 10em;
    left: 60%;
    zindex: 100;
}

.itemdue {
    font-style: italic;
    color: #90d090;
}

.itemoverdue {
    font-style: italic;
    color: #f09090;
}

.checklistreport th{
   background-position: 0% 100%;
}

.checklistreport .header {
    background-color: #e1e1df;
}

.checklistreport .head0 {
    font-weight: bold;
}

.checklistreport .head1 {
    font-weight: normal;
}

.checklistreport .head2 {
    font-weight: normal;
    font-style: italic;
}

.checklistreport .reportheading {
    background-color: #000000;
}

.checklistreport div.comment{
	border:3px dashed #B0B0B0;
	padding:3px;
	margin:2px;
	color:#606060;
}

.checklistreport .chklst-level0 > div.itemstate{
    background-color: #e7e7e7;
}

.checklistreport .chklst-level1 > div.itemstate{
    background-color: #c7c7c7;
}

.checklistreport .chklst-level2 > div.itemstate{
    background-color: #afafaf;
}

.checklistreport .chklst-level0-checked > div.itemstate {
    background-color: #00ff00;
}

.checklistreport .chklst-level1-checked > div.itemstate{
    background-color: #00df00;
}

.checklistreport .chklst-level2-checked > div.itemstate{
    background-color: #00bf00;
}

.checklistreport .chklst-level0-unchecked > div.itemstate{
    background-color: #ef0000;
}

.checklistreport .chklst-level1-unchecked > div.itemstate{
    background-color: #df0000;
}

.checklistreport .chklst-level2-unchecked > div.itemstate{
    background-color: #cf0000;
}

.checklistreport .chklst-level0-done > div.itemstate{
    background-color: #c0ffc0;
}

.checklistreport .chklst-level1-done > div.itemstate{
    background-color: #c0ffc0;
}

.checklistreport .chklst-level2-done > div.itemstate{
    background-color: #c0ffc0;
}

.checklist_progress_outer {
    border-width: 1px;
    border-style: solid;
    border-color: black;
    width: 300px;
    background-color: transparent;
    height: 15px;
    float: left;
    overflow: clip;
    position: relative;
}

.checklist_progress_inner {
    background-color: #229b15;
    height: 100%;
    width: 100%;
    background-repeat: repeat-x;
    background-position: top;
    float: left;
}

.checklist_progress_anim {
    background-color: #98c193;
    height: 15px;
    width: 0;
    background-repeat: repeat-x;
    background-position: top;
    position: absolute;
    z-index: -1;
    left: 0;
    top: 0;
}

.checklistimportexport {
    text-align: right;
    width: 90%;
}

.checklistwarning {
    margin-top: 1em;
    color: #800000;
}

.reportcell{
    font-weight:bolder;
    font-family:sans-serif;
}

.reportcell > div{
    padding:8px;
    border: 2px solid #F0F0F0;
    -moz-border-radius:12px;
    min-height:24px;
}

table.checklistreport{
	min-height:24px;
	padding:2px;
	/* border:solid 3px #F0F0F0; */
}
