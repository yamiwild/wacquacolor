jQuery(document).ready(function($) {
	
$('#slider').DrSlider({
    userCSS: false,
    transitionSpeed: 1000,
    duration: 4000,
    showNavigation: false,
    classNavigation: undefined,
    navigationColor: '#9F1F22',
    navigationHoverColor: '#D52B2F',
    navigationHighlightColor: '#DFDFDF',
    navigationNumberColor: '#000000',
    positionNavigation: 'out-center-bottom',
    navigationType: 'circle',
    showControl: true,
    classButtonNext: undefined,
    classButtonPrevious: undefined,
    controlColor: '#FFFFFF',
    controlBackgroundColor: '#000000',
    positionControl: 'left-right',
    transition: 'slide-left',
    showProgress: false,
    progressColor: '#797979',
    pauseOnHover: true,
    onReady: undefined
});
    


// CONF VERSION IE
	function getInternetExplorerVersion()
    // Retorna a versão do IE ou -1
    {
      var rv = -1; 
      if (navigator.appName == 'Microsoft Internet Explorer')
      {
        var ua = navigator.userAgent;
        var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)	
		  rv = parseFloat( RegExp.$1 );
      }
      return rv;
    }
    function checkVersion()
    {
      var ver = getInternetExplorerVersion();

      if ( ver > -1 )
      {
        //Verifica se o IE é menor que 8
        if ( ver <= 8.0 ){
            window.location.href="erro.html";
        }
      }
    }
   
    //Chama a função para detectar o IE
    checkVersion();
});
//  END JQUERY