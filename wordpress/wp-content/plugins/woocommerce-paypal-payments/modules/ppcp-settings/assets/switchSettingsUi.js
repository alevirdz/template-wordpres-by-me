document.addEventListener("DOMContentLoaded",(()=>{const t=ppcpSwitchSettingsUi,e=document.querySelector(".button.button-settings-switch-ui");e&&e.addEventListener("click",(()=>{fetch(t.endpoint,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({nonce:t.nonce})}).then((t=>{if(!t.ok)throw new Error("Network response was not ok");return t.json()})).then((t=>{window.location.reload()})).catch((t=>{console.error("Error:",t)}))}))}));