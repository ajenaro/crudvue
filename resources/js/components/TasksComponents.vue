<template>
    <div>
        <form @submit.prevent="update(note)" v-if="isEdit">
            <h3>Editar Tarea</h3>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" v-model="note.name"
                       class="form-control"
                       ref="name"
                       placeholder="Nombre">
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <input type="text" v-model="note.description"
                       class="form-control"
                       ref="description"
                       placeholder="Descripción">
            </div>

            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-primary" @click="cancel">Cancelar</button>

        </form>

        <form @submit.prevent="add" v-else>
            <h3>Agregar Tarea</h3>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" v-model="note.name"
                       class="form-control"
                       ref="name"
                       placeholder="Nombre">
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <input type="text" v-model="note.description"
                       class="form-control"
                       ref="description"
                       placeholder="Descripción">
            </div>

            <button class="btn btn-primary mb-2" type="submit">Añadir</button>

        </form>

        <hr class="mb-2">

        <h3>Listado de Notas</h3>

        <ul class="list-group">
            <li class="list-group-item" v-for="(item, index) in notes" :key="index">
                <span class="badge badge-primary float-right">
                    {{ item.created_at }}
                </span>
                <p>{{ item.name }}</p>
                <p>{{ item.description }}</p>
                <button class="btn btn-danger btn-sm" @click="del(item, index)">Eliminar</button>
                <button class="btn btn-warning btn-sm" @click="edit(item,index)">Editar</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notes: [],
            note : {
                name: '',
                description: '',
            },
            isEdit: false
        }
    },
    created() {
        axios.get('/notes')
            .then(res => {
                this.notes = res.data;
            })
    },
    methods: {
        add() {
            // validate fields
            // ...
            let parms = {
                name: this.note.name,
                description: this.note.description
            }

            // clear fields
            this.note.name = '';
            this.note.description = '';

            axios.post('/notes', parms)
                .then(res => {
                    this.notes.push(res.data)
            })
        },
        del(item, index) {
            axios.delete(`/notes/${item.id}`)
                .then(() => {
                    this.notes.splice(index, 1);
                })
        },
        edit(item) {
            this.isEdit = true;
            this.note.name = item.name;
            this.note.description = item.description;
            this.note.id = item.id;
        },
        update(note) {
            let params = {
                name: note.name,
                description: note.description,
                id: note.id
            }

            axios.put(`/notes/${note.id}`, params)
                .then(res => {
                    this.isEdit = false;
                    this.note = {
                        name: '',
                        description: ''
                    }
                    const index = this.notes.findIndex(item => item.id === note.id);
                    this.notes[index] = res.data;
                })
        },
        cancel() {
            this.isEdit = false;
            this.note = {
                name: '',
                description: ''
            };
        }
    }
}
</script>

<style scoped>

</style>
