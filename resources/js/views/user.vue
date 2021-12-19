<template>
<v-container>
    <h1>Пользователи</h1>
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
            <label for="textName" class="form-label">Введите имя пользователя</label>
            <input type="text" v-model="user.name" class="form-control">            
        </div> 
        <div class="col-md-3">
            <button type="button" class="btn btn-success test-btn" @click="save()">{{btnSave}}</button>
        </div>       
    </div>
    <div class="row">
        <div>
            <v-data-table
                :headers="headers"
                :items="users"
                :items-per-page="5"
                class="elevation-1"
                > 
                 <template v-slot:item.actions="{ item }">
                    <v-btn
                    depressed
                    color="primary"
                    @click="updateUser(item)"
                    >
                    Изменить
                    </v-btn>
                     <v-btn
                    depressed
                    color="error"
                    @click="removeUser(item)"
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
                >Вы уверены что хотите удалить пользователя {{userRemove.name}}?</v-card-title
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
            userRemove:{name:''},
            dialogDelete: false,
            btnSave: 'Добавить',
            user:{name:''},
            message: null,
             headers: [
                {
                    text: "Имя",
                    align: "start",
                    sortable: false,
                    value: "name",
                },                
                { text: "Action", value: 'actions' },
            ],
            users:[]
        }
    },
    async mounted() {
        await this.loadUser();
    },
    methods:{
        async save(){ 
            if(this.btnSave==='Добавить'){
                let data = await axios
                .post(`/api/user/`, this.user)
                .then((response) => response.data)
                .catch(function (error) {
                return error.response;
                }); 
                if(data.status == true){
                    this.message='Пользователь добавлен успешно';
                    setTimeout(() => this.message=null, 5000);
                    this.users.push(data.user);
                    this.user={name:''};
                }        
            }else if(this.btnSave==='Сохранить'){
                let data = await axios
                .put(`/api/user/${this.user.id}`, this.user)
                .then((response) => response.data)
                .catch(function (error) {
                return error.response;
                }); 
                if(data.status == true){
                    this.message='Пользователь успешно обновлен';
                    setTimeout(() => this.message=null, 5000); 
                    this.user={name:''};
                    this.btnSave='Добавить';
                }      
            }           
               
        },
        async loadUser(){
            this.users = await axios
            .get(`/api/user/`)
            .then((response) => response.data)
            .catch(function (error) {
            return error.response;
            });  
            console.log(this.users)          
        },
        updateUser(item){
            this.btnSave='Сохранить';
            this.user=item;
        },
        removeUser(item) {
            this.userRemove = item;
            this.dialogDelete = true;
        },
        closeDelete() {
            this.dialogDelete = false;
            this.userRemove={name:''};
        },
        async deleteItem(){
            let data = await axios
            .delete(`/api/user/${this.userRemove.id}`)
            .then((response) => response.data)
            .catch(function (error) {
            return error.response;
            });
            if(data.status == true){
                this.message='Пользователь успешно удален';
                setTimeout(() => this.message=null, 5000);
                this.userRemove={name:''}; 
                await this.loadUser();               
            } 
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