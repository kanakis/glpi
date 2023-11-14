/**
 * -------------------------------------------------------------------------
 * Example plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of Example.
 *
 * Example is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Example is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Example. If not, see <http://www.gnu.org/licenses/>.
 * -------------------------------------------------------------------------
 * @copyright Copyright (C) 2006-2022 by Example plugin team.
 * @license   GPLv2 https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/pluginsGLPI/example
 * -------------------------------------------------------------------------
 */

var jsAccessRights=false ; 
//console.log 'ACR :' + jsAccessRights ;
function handleChange(checkbox) 
{
    if(checkbox.checked == true)
    {
        jsAccessRights= true; 
        //console.log 'ACR :' + jsAccessRights ;
        //document.getElementById('submit').removeAttribute('disabled');
    }else{
        if(jsAccessRights==false){}

    //document.getElementById('submit').setAttribute('disabled', 'disabled');
    }
}
// function setACR(){jsAccessRights= True ; return }
function showBlocks()
{
    console.log('showBlocks');
    var getSelectValue = document.getElementById('RequestType').value;
    if(getSelectValue !=='')
    {
        if((getSelectValue == '1.Προσθήκη δικαιωμάτων χρήστη.')||
            (getSelectValue == '2.Αφαίρεση δικαιωμάτων χρήστη.')||
            (getSelectValue == '3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.'))
            {
                    //document.getElementById('UserName').style.display='block';
                document.getElementById('UserRights').style.display='table-row';
                document.getElementById('InternetPages').style.display='table-row';
                document.getElementById('HWRights').style.display='table-row';
                document.getElementById('PassRequestTypeVar').value  = '1' ;
            }else
            { 
                // document.getElementById('UserName').style.display='block';
                document.getElementById('UserRights').style.display='none';
                document.getElementById('InternetPages').style.display='none';
                document.getElementById('HWRights').style.display='none';
            }   
        if((getSelectValue == '4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.'))
        {
            document.getElementById('UserName').style.display='table-row';
            document.getElementById('PassRequestTypeVar').value  = '2';
        }else
        {
            document.getElementById('UserName').style.display='block';
        }
    
    }
    //alert(getSelectValue);
    if(getSelectValue ==='')
    {
        getSelectValue = '1.Προσθήκη δικαιωμάτων χρήστη.' ; 
        document.getElementById('PassRequestTypeVar').value  = '1' ; 
    }
    
        //document.getElementById('PassValue').style.display='block';
    
}
function validateForm() 
{
    var jsTitleTxt = document.getElementById('TitleTxt').value;
    var jsRequestType = document.getElementById('RequestType').value;
    var jsKlados = document.getElementById('Klados').value;
    var jsUserFor = document.getElementById('UserFor').value;
    
    if( jsRequestType == ''){ alert('Παρακαλώ επιλέξτε είδος αίτησης!'); return false;}
    if( jsTitleTxt == ''){ alert('Παρακαλώ δώστε ένα Τίτλο/ Περιγραφή για το αίτημα'); return false;}
    if( jsKlados == ''){ alert('Παρακαλώ επιλέξτε κλάδο!'); return false;}
    if( (jsUserFor == '') &&(jsRequestType !='3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.') ){ alert('Παρακαλώ επιλέξτε χρήστη!'); return false;}
    //if( (jsAccessRights ==false )&& (jsRequestType !='4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.')){alert('Παρακαλώ επιλέξτε τουλάχιστον 1 δικαίωμα !'); return false;} 
}


{/* <script>
      var jsAccessRights=false ; 
      //console.log 'ACR :' + jsAccessRights ;
      function handleChange(checkbox) {
         if(checkbox.checked == true){
            jsAccessRights= true; 
            //console.log 'ACR :' + jsAccessRights ;
             //document.getElementById('submit').removeAttribute('disabled');
         }else{
            if(jsAccessRights==false){}

            //document.getElementById('submit').setAttribute('disabled', 'disabled');
        }
     }
     // function setACR(){jsAccessRights= True ; return }
      function showBlocks(){
          console.log('showBlocks');
          var getSelectValue = document.getElementById('RequestType').value;
          if(getSelectValue !==''){
            if((getSelectValue == '1.Προσθήκη δικαιωμάτων χρήστη.')||
               (getSelectValue == '2.Αφαίρεση δικαιωμάτων χρήστη.')||
               (getSelectValue == '3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.')){
               //document.getElementById('UserName').style.display='block';
               document.getElementById('UserRights').style.display='table-row';
               document.getElementById('InternetPages').style.display='table-row';
               document.getElementById('HWRights').style.display='table-row';
               document.getElementById('PassRequestTypeVar').value  = '1' ;
               }else{ 
               // document.getElementById('UserName').style.display='block';
                  document.getElementById('UserRights').style.display='none';
                  document.getElementById('InternetPages').style.display='none';
                  document.getElementById('HWRights').style.display='none';
               }   
            if(
               (getSelectValue == '4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.')){
                  document.getElementById('UserName').style.display='table-row';
                  document.getElementById('PassRequestTypeVar').value  = '2';
               }else{
                  document.getElementById('UserName').style.display='block';
               7}
         
         }
          //alert(getSelectValue);
          if(getSelectValue ===''){
            getSelectValue = '1.Προσθήκη δικαιωμάτων χρήστη.' ; 
            document.getElementById('PassRequestTypeVar').value  = '1' ; 
          }
          
          //document.getElementById('PassValue').style.display='block';
          
      }
      function validateForm() {
         var jsTitleTxt = document.getElementById('TitleTxt').value;
         var jsRequestType = document.getElementById('RequestType').value;
         var jsKlados = document.getElementById('Klados').value;
         var jsUserFor = document.getElementById('UserFor').value;
         
         if( jsRequestType == ''){ alert('Παρακαλώ επιλέξτε είδος αίτησης!'); return false;}
         if( jsTitleTxt == ''){ alert('Παρακαλώ δώστε ένα Τίτλο/ Περιγραφή για το αίτημα'); return false;}
         if( jsKlados == ''){ alert('Παρακαλώ επιλέξτε κλάδο!'); return false;}
         if( (jsUserFor == '') &&(jsRequestType !='3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.') ){ alert('Παρακαλώ επιλέξτε χρήστη!'); return false;}
         //if( (jsAccessRights ==false )&& (jsRequestType !='4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.')){alert('Παρακαλώ επιλέξτε τουλάχιστον 1 δικαίωμα !'); return false;} 
       }
   </script> */}