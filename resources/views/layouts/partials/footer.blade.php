<footer class="pb-4 bg-primary" style="color: #fff">
    <hr class="my-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                {{ config('app.name') }}
            </div>
            <div class="col-md-6">
                <div class="copyright text-right">
                    Copyright © 2018
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="/js/jquery.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/custom.js"></script>

@stack('scripts')