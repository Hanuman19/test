<template>
<v-container>
    <h1>Проекты</h1>
     <v-alert
      v-if="message !== null"
      dense
      text
      type="success"
    >
      {{message}}
    </v-alert>
    <div class="row">        
        <div class="col-md-3">
            <label for="textName" class="form-label">Введите название проекта</label>
            <input type="text" v-model="project.name" class="form-control">            
        </div> 
        <div class="col-md-3">
            <button type="button" class="btn btn-success test-btn" @click="save()">{{btnSave}}</button>
        </div>       
    </div>
    <div class="row">
        <div>
            <v-data-table
                :headers="headers"
                :items="projects"
                :items-per-page="5"
                class="elevation-1"
                > 
                 <template v-slot:item.actions="{ item }">
                    <v-btn
                    depressed
                    color="primary"
                    @click="updateProject(item)"
                    >
                    Изменить
                    </v-btn>
                     <v-btn
                    depressed
                    color="error"
                    @click="removeProject(item)"
                    >
                    Удалить
                    </v-btn>                 
                </template>              
            </v-data-table>
        </div>
    </div>
    <v-dialog v-model="dialogDelete" max-width="550px">
            <v-card>
              <v-card-title class="text-h5"
                >Вы уверены что хотите удалить проект {{projectRemove.name}}?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="#103c36" text @click="closeDelete()"
                  >Отмена</v-btn
                >
                <v-btn color="#103c36" text @click="deleteItem()"
                  >Да уверен</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
</v-container>
</template>
<script>
export default {
    data() {
        return {
            projectRemove:{name:''},
            dialogDelete: false,
            btnSave: 'Добавить',
            project:{name:''},
            message: null,
             headers: [
                {
                    text: "Название",
                    align: "start",
                    sortable: false,
                    value: "name",
                },                
                { text: "Action", value: 'actions' },
            ],
            projects:[]
        }
    },
    async mounted() {
        await this.loadProject();
    },
    methods:{
        async save(){ 
            if(this.btnSave==='Добавить'){
                let data = await axios
                .post(`/api/project/`, this.project)
                .then((response) => response.data)
                .catch(function (error) {
                return error.response;
                }); 
                if(data.status == true){
                    this.message='Проект добавлен успешно';
                    setTimeout(() => this.message=null, 5000);
                    this.projects.push(data.project);
                    this.project={name:''};
                } 
                console.log(data)       
            }else if(this.btnSave==='Сохранить'){
                let data = await axios
                .put(`/api/project/${this.project.id}`, this.project)
                .then((response) => response.data)
                .catch(function (error) {
                return error.response;
                }); 
                if(data.status == true){
                    this.message='Проект успешно обновлен';
                    setTimeout(() => this.message=null, 5000); 
                    this.project={name:''};
                    this.btnSave='Добавить';
                }      
            }           
               
        },
        async loadProject(){
            this.projects = await axios
            .get(`/api/project/`)
            .then((response) => response.data)
            .catch(function (error) {
            return error.response;
            });    
        },
        updateProject(item){
            this.btnSave='Сохранить';
            this.project=item;
        },
        removeProject(item) {
            this.projectRemove = item;
            this.dialogDelete = true;
        },
        closeDelete() {
            this.dialogDelete = false;
            this.projectRemove={name:''};
        },
        async deleteItem(){
            let data = await axios
            .delete(`/api/project/${this.projectRemove.id}`)
            .then((response) => response.data)
            .catch(function (error) {
            return error.response;
            });
            if(data.status == true){
                this.message='Проект успешно удален';
                setTimeout(() => this.message=null, 5000);
                this.projectRemove={name:''}; 
                await this.loadProject();               
            } 
            console.log(data)
            this.dialogDelete = false;   
        }
    }

}
</script>

<style>
.test-btn{
    margin-top: 31px !important;
}
</style>