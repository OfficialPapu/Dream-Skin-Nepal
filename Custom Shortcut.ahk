; Youtube - Ctrl+Shift+Y 
^+Y::Run, https://www.youtube.com 

; ChatGPT - Ctrl+Shift+C
^+C::Run, https://chatgpt.com/ 

; Localhost Dream Skin Nepal - Ctrl+Shift+D
^+D::Run, http://localhost/Dream Skin Nepal/ 

; VS Code For Dream Skin Nepal - Ctrl+Alt+D
^!D::Run, "C:\Users\papuy\AppData\Local\Programs\Microsoft VS Code\Code.exe" "C:\xampp\htdocs\Dream Skin Nepal" 

; Notepad - Win+N
<#N::Run, Notepad

; Dream Skin cPanel - Ctrl+Alt+C
^!C::Run, https://dreamskinnepal.com:2083/ 

; Dream Skin Admin Panel - Ctrl+Alt+A
^!A::Run, https://dreamskinnepal.com/Admin 

; VS Code - Ctrl+Shift+V
^+V::
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
        Run, "C:\Users\papuy\AppData\Local\Programs\Microsoft VS Code\Code.exe" "%path%"
    }
    else
    {
        Run, "C:\Users\papuy\AppData\Local\Programs\Microsoft VS Code\Code.exe" "C:\Users\papuy\OneDrive\Desktop\React"
    }
return

; Open Brave - Ctrl+Shift+B
^+B::
    IfWinExist ahk_class Chrome_WidgetWin_1
    {
        WinActivate ; Activate the existing Brave window
        Send, ^t ; Open a new tab
    }
    else
    {
        Run, "C:\Program Files\BraveSoftware\Brave-Browser\Application\brave.exe"
    }
return
