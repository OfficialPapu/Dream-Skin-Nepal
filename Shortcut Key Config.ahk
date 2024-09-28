;Youtube - Ctrl+Shift+Y 
^+Y::Run, https://www.youtube.com 

;chatgpt - Ctrl+Shift+C
^+C::Run, https://chatgpt.com 

;Localhost Dream Skin Nepal - Ctrl+Shift+D
^+D::Run, http://localhost/Dream Skin Nepal 

;Vs Code For Dream Skin Nepal - Ctrl+Alt+D
^!D::Run, "C:\Users\pappu\AppData\Local\Programs\Microsoft VS Code\Code.exe" "C:\xampp\htdocs\Dream Skin Nepal" 

;Notepad - Win+N
<#N::Run, Notepad

;Dream Skin cPanel - Ctrl+Alt+C
^!C::Run, https://dreamskinnepal.com:2083

;Dream Skin Admin Panel - Ctrl+Alt+A
^!A::Run, https://dreamskinnepal.com/Admin

; Vs Code - Ctrl+Shift+V
^+v::
    WinGetClass, class, A
    if (class = "CabinetWClass" or class = "ExplorerWClass")
    {
        for window in ComObjCreate("Shell.Application").Windows
        {
            if (InStr(window.FullName, "explorer.exe") && window.hwnd = WinExist("A"))
            {
                path := window.document.Folder.Self.Path
                break
            }
        }
         Run, "C:\Users\pappu\AppData\Local\Programs\Microsoft VS Code\Code.exe" "%path%"
    }
    else
    {
        Run, "C:\Users\pappu\AppData\Local\Programs\Microsoft VS Code\Code.exe" "C:\Users\pappu\OneDrive\Desktop\React"
    }
return

;Brave - Ctrl+Shift+B
^+B::
    IfWinExist ahk_class Chrome_WidgetWin_1
    {
        WinActivate 
        Send, ^t 
    }
    else
    {
        Run, "C:\Program Files\BraveSoftware\Brave-Browser\Application\brave.exe"
    }
return

#m:: ;Movie - Win+M
Run, "D:\Movies & Web Series",,Max
return


#+E:: ; Shortcut Folder - Win+Shift+E
Run, "C:\Users\pappu\AppData\Roaming\Microsoft\Windows\Start Menu\Programs\Startup",,Max
return

#+D:: ;Download Folder - Win+Shift+D
Run, "C:\Users\pappu\Downloads",,Max
return

;Emali
::mail::papuyadavofficial386@gmail.com
::dmail::dreamskinnepal@gmail.com
::tmail::abc106065@gmail.com
return