<template>
   <div class="container">
       <div class="modal is-active" v-if="showForm">
           <div class="modal-background"></div>
           <div class="modal-card">
               <header class="modal-card-head">
                   <p class="modal-card-title">Modal title</p>
                   <button @click="closeShowForm" class="delete" aria-label="close"></button>
               </header>
               <section class="modal-card-body">

                       <div class="field">
                           <label class="label">Tiêu đề</label>
                           <div class="control">
                               <input class="input " type="text" placeholder="Nhập tiêu đề" v-model="form.title">
                           </div>
                        </div>
                       <div class="field">
                           <label class="label">Nội dung</label>
                           <div class="control">
                               <textarea class="textarea" placeholder="Nhập nội dung" v-model="form.content"></textarea>
                           </div>
                       </div>

               </section>
               <footer class="modal-card-foot">
                   <button class="button is-success" @click="submitNote(form)">Save note</button>
                   <button class="button" @click="closeShowForm">Cancel</button>
               </footer>
           </div>
       </div>
        <div>
            <button class="button is-primary" @click="openShowForm">New Note</button>
        </div>
       <div class="note-content" v-for="(note,index) in listNote" :key="index">
           <div class="header">
               <p class="is-pulled-left has-text-weight-bold pd-6">{{note.title}}</p>
               <p class="is-pulled-right"><i @click="deleteNote(note,index)" class="fa fa-trash" aria-hidden="true"></i></p>
           </div>
           <div class="content">
               <p>{{note.content}}</p>
           </div>
           <div class="footer">
               <span>Người đăng : {{note.create_by}}</span>
               <span class="fa fa-share" aria-hidden="true"></span>
               <span @click="toggleStar" class="fa fa-star fa-2x is-pulled-right is-hover" :class="{'yellow':isSave}" aria-hidden="true"></span>

           </div>
       </div>
   </div>
</template>

<script>
    export default {
        name: "Home",
        data(){
            return{
                form:{
                    title:'',
                    content:'',
                },
                showForm:false,
                listNote:[],
                isSave:false
            }
        },
        components:{},
        methods:{
            openShowForm(){
                this.showForm=true;
            },
            closeShowForm(){
                this.showForm=false
            },
            submitNote(value){
               axios.post('api/note/create',this.form)
                    .then( res =>{
                        this.closeShowForm();
                        this.form.title='';
                        this.form.content='';
                        this.getListNote();
                    })
                    .catch( err =>{
                        console.log(err)
                    })
            },
            getListNote(){
                axios.get('api/note/list')
                    .then(res =>{
                        console.log(res)
                        this.listNote=res.data.data.notes.data;

                    })
                    .catch( err =>{
                        console.log(err)
                    })
            },
            deleteNote(note,index){
                axios.delete('api/note/delete/'+note.id)
                    .then(res =>{
                        this.listNote.splice(index,1)
                    })
                    .catch(err =>{
                        console.log(err);
                    })
            },
            toggleStar(){
                    return  this.isSave = !this.isSave;
            }

        },
        mounted() {

        },
        created() {
            this.getListNote();
        },
        destroyed() {

        },

    }
</script>

<style lang="scss" scoped>
    .header {
        width: 500px;
        display: flex;
    }
    .pd-6{
        padding-right: 30px;
    }
    .is-pulled-right{
        cursor: pointer;
    }
    .note-content{
        padding-bottom: 10px;
        border-bottom: 1px solid gray;
    }
    .is-hover{
        cursor: pointer;
    }
    .yellow{
        color: yellow;
    }

</style>
