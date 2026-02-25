import React from 'react';
import Link from 'next/link';
import Image from 'next/image';

const Footer = ({ site }: { site?: any }) => {
    return (
        <footer className="bg-[#030a08] text-slate-400 py-20 border-t border-white/5">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">

                    <div className="col-span-1 md:col-span-2 space-y-6">
                        <Link href="/" className="inline-flex items-center gap-3 group">
                            {site?.logo && (
                                <div className="relative w-7 h-7 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <Image src={`http://localhost:8000${site.logo}`} alt="Logo" fill className="object-contain" />
                                </div>
                            )}
                            <span className="text-2xl font-bold tracking-tight text-white hover:text-gold-400 transition-colors">
                                {site?.name || 'iFuture Hub'}
                            </span>
                        </Link>
                        <p className="text-sm font-medium leading-relaxed max-w-sm">
                            Delivering seamless, smart digital solutions globally. Empowering businesses with the systems they need to connect, scale, and evolve.
                        </p>

                        {/* Dynamics Contact Block */}
                        <div className="space-y-3 pt-2">
                            {site?.address && (
                                <div className="flex items-start gap-3 text-sm font-medium">
                                    <span className="text-primary-500 mt-0.5">📍</span>
                                    <span className="text-slate-300 leading-relaxed">{site.address}</span>
                                </div>
                            )}
                            {site?.email && (
                                <div className="flex items-center gap-3 text-sm font-medium">
                                    <span className="text-primary-500">✉️</span>
                                    <a href={`mailto:${site.email}`} className="text-slate-300 hover:text-white transition-colors">{site.email}</a>
                                </div>
                            )}
                            {site?.phone && (
                                <div className="flex items-center gap-3 text-sm font-medium">
                                    <span className="text-primary-500">📞</span>
                                    <a href={`tel:${site.phone}`} className="text-slate-300 hover:text-white transition-colors" dir="ltr">{site.phone}</a>
                                </div>
                            )}
                        </div>

                        <div className="flex space-x-4 flex-row-reverse rtl:space-x-reverse pt-2">
                            <a href="#" className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-300 hover:bg-primary-600 hover:text-white transition-all"><span className="sr-only">LinkedIn</span>in</a>
                            <a href="#" className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-300 hover:bg-primary-600 hover:text-white transition-all"><span className="sr-only">Twitter</span>𝕏</a>
                            <a href="#" className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-300 hover:bg-primary-600 hover:text-white transition-all"><span className="sr-only">GitHub</span>Git</a>
                        </div>
                    </div>

                    <div>
                        <h4 className="text-white font-bold text-sm tracking-widest uppercase mb-6">Platforms</h4>
                        <ul className="space-y-4 text-sm font-medium">
                            <li><a href="#" className="hover:text-primary-400 transition-colors">Card iFuture</a></li>
                            <li><a href="#" className="hover:text-primary-400 transition-colors">Kashier System</a></li>
                            <li><a href="#" className="hover:text-primary-400 transition-colors">Events Hub</a></li>
                            <li><a href="#" className="hover:text-primary-400 transition-colors">CRM Core</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 className="text-white font-bold text-sm tracking-widest uppercase mb-6">Company</h4>
                        <ul className="space-y-4 text-sm font-medium">
                            <li><a href="#" className="hover:text-primary-400 transition-colors">About Us</a></li>
                            <li><a href="#" className="hover:text-primary-400 transition-colors">Partners</a></li>
                            <li><a href="#" className="hover:text-primary-400 transition-colors">Contact Sales</a></li>
                            <li><a href="#" className="hover:text-primary-400 transition-colors">Admin Portal</a></li>
                        </ul>
                    </div>
                </div>

                <div className="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center text-xs font-bold text-slate-500">
                    <p dir="ltr" className="text-left md:text-right">{site?.copyright || `© ${new Date().getFullYear()} iFuture Hub. All rights reserved.`}</p>
                    <div className="flex space-x-6 rtl:space-x-reverse mt-6 md:mt-0">
                        <a href="#" className="hover:text-slate-300 transition-colors">Privacy Policy</a>
                        <a href="#" className="hover:text-slate-300 transition-colors">Terms of Service</a>
                        <a href="#" className="hover:text-slate-300 transition-colors">Cookie Guidelines</a>
                    </div>
                </div>
            </div>
        </footer>
    );
};

export default Footer;
