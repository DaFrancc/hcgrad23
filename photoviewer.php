<!DOCTYPE html>
<html lang="en">

<head>
	<title>Grad '23 Photo Viewer</title>
	<link rel="stylesheet" type="text/css" href="stylePV.css?v=13" />
	<link rel="icon" href="favicon.png" />
	<meta http-equiv=Content-Type content=text/html; charset=utf-8 />
</head>

<body>
	<div id="wrapper">
	    <div id="viewer">
	        <div id="top-bar">
	            <table class="right-align">
	                <tbody>
	                    <tr>
	                        <td class="spacing">
	                            <div id="download-button">
	                                <a class="action-button" id="download-anchor" download>
	                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 256 256"><path d="M224,152v56a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V152a8,8,0,0,1,16,0v56H208V152a8,8,0,0,1,16,0Zm-101.66,5.66a8,8,0,0,0,11.32,0l40-40a8,8,0,0,0-11.32-11.32L136,132.69V40a8,8,0,0,0-16,0v92.69L93.66,106.34a8,8,0,0,0-11.32,11.32Z"></path></svg>
                                        
	                                </button>
	                            </div>
	                        </td>
	                        <td class="spacing">
	                            <div id="close-button">
	                                <button class="action-button" onclick="closePanel()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 256 256"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
	                                </button>
	                            </div>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
    		<div id="viewpanel">
    			<img id="selected-img" src=""/>
    		    <div id="transparent-background" onclick="closePanel()"></div>
    		</div>
	    </div>
	    <div id="header">
	        <div id="title">
	            <h1>Photo Gallery</h1>
	            <div>
	                <form id="downloadForm" action="downloadzip.php" method="POST">
						<div id="download-all">
							<input type="hidden">
							<button id="download-all-button" type="submit">Download All Photos</button>
						</div>
					</form>
	            </div>
	        </div>
	    </div>
		<div id="photogrid">
			<?php
			    include('photogrid.php')
			?>
		</div>
	</div>
	<script src="scriptPV.js?v=6"></script>
</body>

</html>