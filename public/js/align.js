function align_application() 
{
	var application_left = document.getElementsByClassName('application_left');
	var application_right = document.getElementsByClassName('application_right');

	for(i=0;i<application_left.length;i++)
	{
		if (application_left[i].clientHeight >= application_right[i].clientHeight){
		application_right.style.height = application_left.clientHeight + 'px';
		}
		else{
			application_left[i].style.height = application_right[i].clientHeight + 'px';
		}
		
	}
	
}

window.onload = align_application();