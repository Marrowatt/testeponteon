<template>
    <div class="container-fluid">
        <div class="row">
            <h2>Cadastro de usuários</h2>
        </div>

        <div class="row">

            <label for="name" class="my-1">Nome completo: </label>
            <input type="text" name="name" id="name" v-model='user.name' class="form-control" required>

            <label for="phone" class="my-1">Celular: </label>
            <input type="text" name="phone" id="phone" v-model='user.phone' class="form-control" v-mask="'(##) #####-####'" required>

            <label for="estate" class="my-1">Estado: </label>
            <select name="estate" id="estate" class="form-control" required v-model="user.estate">
                <option :value="e.id" v-for="(e, index) in estates" :key="index">{{ e.name }}</option>
            </select>

            <label for="city" class="my-1">Cidade: </label>
            <select name="city" id="city" class="form-control" required v-model="user.city">
                <option :value="c.id" v-for="(c, index) in cities" :key="index">{{ c.name }}</option>
            </select>

            <label for="father" class="my-1">Pai empresarial: </label>
            <select name="father" id="father" class="form-control" v-model="user.father"> 
                <option :value="f.id" v-for="(f, index) in fathers" :key="index">{{ f.name }}</option>
            </select>

            <button class="btn btn-primary btn-block my-2" @click="sendToUp">Salvar</button>

        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                user: {
                    name: "",
                    phone: "",
                    estate: 0,
                    city: 0,
                    father: ""
                },
                estates: {},
                cities: {},
                fathers: {}
            }
        },
        mounted() {
            this.getEstates();
            this.getFathers();
        },
        methods: {
            getEstates() {
                axios.get('/getEstates').then(data => {
                    this.estates = data.data;
                });
            },
            getCities() {
                axios.get('/getCities/' + this.user.estate).then(data => {
                    this.cities = data.data;
                });
            },
            getFathers() {
                axios.get('/getFathers').then(data => {
                    this.fathers = data.data;
                });
            },
            sendToUp () {
                this.$emit('creating', { user: this.user });
            }
        },
        watch: {
            'user.estate' (val) {
                if(val != 0) this.getCities();
            },
        }
    }
</script>