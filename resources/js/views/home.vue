<template>
    <v-container>
        <h1>Home</h1> 
        <v-alert
        v-if="message !== null"
        dense
        text
        type="success"
        >
        {{message}}
        </v-alert>
        <div class="row">
            <div>
                <v-simple-table height="300px">
                    <template v-slot:default>
                        <thead>
                        <tr>
                            <th class="text-left">
                            Проект
                            </th>
                            <th class="text-left">
                            Понедельник
                            </th>
                            <th class="text-left">
                            Вторник
                            </th>
                            <th class="text-left">
                            Среда
                            </th>
                            <th class="text-left">
                            Четверг
                            </th>
                            <th class="text-left">
                            Пятница
                            </th>
                            <th class="text-left">
                            Суббота
                            </th>
                            <th class="text-left">
                            Воскресенье
                            </th>
                            <th class="text-left">
                            Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="item in plans"
                            :key="item.index"
                        >
                            <td>{{ item.project.name }}</td>
                            <td class="test-td"><v-select
                                v-model="item.user_mo"
                                :items="users"
                                item-text="name"
                                item-value="id"
                                label="Select"
                                return-object                               
                                chips
                                solo
                                persistent-hint
                            ></v-select></td>
                            <td><v-select
                                v-model="item.user_tu"
                                :items="users"
                                item-text="name"
                                item-value="id"
                                label="Select"
                                return-object                               
                                chips
                                solo
                                persistent-hint
                            ></v-select></td>
                            <td><v-select
                                v-model="item.user_we"
                                :items="users"
                                item-text="name"
                                item-value="id"
                                label="Select"
                                return-object                               
                                chips
                                solo
                                persistent-hint
                            ></v-select></td>
                            <td><v-select
                                v-model="item.user_thu"
                                :items="users"
                                item-text="name"
                                item-value="id"
                                label="Select"
                                return-object                               
                                chips
                                solo
                                persistent-hint
                            ></v-select></td>
                            <td><v-select
                                v-model="item.user_fri"
                                :items="users"
                                item-text="name"
                                item-value="id"
                                label="Select"
                                return-object                               
                                chips
                                solo
                                persistent-hint
                            ></v-select></td>
                            <td><v-select
                                v-model="item.user_sa"
                                :items="users"
                                item-text="name"
                                item-value="id"
                                label="Select"
                                return-object                               
                                chips
                                solo
                                persistent-hint
                            ></v-select></td>
                            <td><v-select
                                v-model="item.user_su"
                                :items="users"
                                item-text="name"
                                item-value="id"
                                label="Select"
                                return-object                               
                                chips
                                solo
                                persistent-hint
                            ></v-select></td>
                            <td><button type="button" class="btn btn-success" @click="save(item)">Обновить</button> </td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </div>
        </div> 
        <div class="row">
            <div> 
                
            </div>
        </div>    
    </v-container>
</template>
<script>
export default {
    name: "home",
    data() {
        return {
            message:null,
            plans:null,
            users:null
        }
    },
    async mounted() {
        await this.loadUser();
        await this.loadProject();
        
    },
    methods :{
        async loadProject(){
            this.plans = await axios
            .get(`/api/plan/`)
            .then((response) => response.data)
            .catch(function (error) {
            return error.response;
            });
            console.log(this.plans)    
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
        async save(item){
            console.log(item)
            let data = await axios
            .put(`/api/plan/${item.id}`,item)
            .then((response) => response.data)
            .catch(function (error) {
            return error.response;
            });
            if(data.status == true){
                this.message='План на неделю обноалён успешно';
                setTimeout(() => this.message=null, 5000);                
            } 
        }
    }
}
</script>
<style>
 .test-td{
     vertical-align:center !important;
 }
</style>