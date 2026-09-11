import {DM_Sans,Manrope} from 'next/font/google';
const bodyFont=DM_Sans({subsets:['latin'],variable:'--font-body',display:'swap'});const headingFont=Manrope({subsets:['latin'],variable:'--font-heading',display:'swap'});
import type {Metadata} from 'next';import './globals.css';
export const metadata:Metadata={metadataBase:new URL(process.env.NEXT_PUBLIC_SITE_URL||'http://localhost:3000'),title:{default:'Nexus School — Criando profissionais.',template:'%s | Nexus School'},description:'Formação técnica, superior e profissionalizante. Conheça a Nexus School, um projeto educacional demonstrativo da Nexus Inc.',robots:{index:false,follow:false}};
export default function RootLayout({children}:{children:React.ReactNode}){return <html lang="pt-BR" suppressHydrationWarning><body className={`${bodyFont.variable} ${headingFont.variable}`}><a className="skip" href="#conteudo">Pular para conteúdo</a>{children}</body></html>}
