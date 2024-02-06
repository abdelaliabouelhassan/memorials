import { defineStore } from 'pinia'


export const useStore = defineStore('states', {
    state: () => {
        return {
            user:[],
            qrcode_assiged:false,
            qrcode_claimed:false,
            profile:{
                step1:{
                    image:'',
                    fullname:'',
                    residence:'',
                    religious:'',
                    birthday:'',
                    death:'',
                    profession:'',
                    miscellaneous:'',
                    description:''
                },
                step2:{
                    images:[]
                },
                step3:{
                    password:'',
                    private:''
                }
            }
        } 
    },
  
 
})