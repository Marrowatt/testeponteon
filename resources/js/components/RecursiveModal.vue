<template>
    <div class="container">
        <div class="modal fade" id="seeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vendo Rede</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p v-html="test"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            rec: Array,
            user: String
        },
        data () {
            return {
                test: ""
            }
        },
        mounted() {
        },
        methods: {
            organize () {
                this.test = "- " + this.user;

                this.rec.forEach(el => {
                    var istring = '&emsp;';

                    for(var i = 0; i < parseInt(el[0]); i++) {
                        istring += '&emsp;';
                    }

                    this.test += "<br>" + istring + "- " + el[1]; 
                });
            }
        },
        watch: {
            rec (val) {
                this.organize();
            }
        }
    }
</script>
