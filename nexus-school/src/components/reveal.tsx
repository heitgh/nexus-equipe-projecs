'use client';
import {motion,useReducedMotion} from 'motion/react';
export function Reveal({children,className=''}:{children:React.ReactNode,className?:string}){const reduced=useReducedMotion();return <motion.div className={className} initial={false} whileInView={reduced?{}:{opacity:[0.5,1],y:[18,0]}} viewport={{once:true,amount:.1}} transition={{duration:.65}}>{children}</motion.div>}
