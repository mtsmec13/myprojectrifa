@if (!env('HIDE_FOOTER'))
<footer class="footer "
    style="height:auto;background-color: #000;margin-top:0px!important; text-align: center;">
    @if (env('AGENCIA_BRN'))
        <a href="https://robsonhost.com.br/" target="_blank" style="text-decoration: none"><span
                class="text-muted" style="color: #fff!important; font-size: 12px;">Desenvolvido por Robson Host</span></a>
        </div>
    @else
        <a href="https://robsonhost.com.br/" target="_blank" style="text-decoration: none"><span
                class="text-muted" style="color: #fff!important; font-size: 12px;">Desenvolvido por Robson Host</span></a>
        </div>
    @endif
</footer>
@endif