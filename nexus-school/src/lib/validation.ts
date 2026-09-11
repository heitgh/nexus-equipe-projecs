import {z} from 'zod';
export const loginSchema=z.object({identifier:z.string().trim().min(3).max(254),password:z.string().min(1).max(128)});
export const signupSchema=z.object({name:z.string().trim().min(2,'Informe seu nome.').max(120),email:z.email('Informe um e-mail válido.'),password:z.string().min(12,'Use pelo menos 12 caracteres.').max(128),course:z.string().min(1,'Escolha um curso.'),consent:z.literal(true,{error:'Aceite os termos para continuar.'})});
export const passwordSchema=z.string().min(12,'Use pelo menos 12 caracteres.').max(128);
