export interface Links {
    first: string;
    last?: string;
    prev?: string;
    next?: string;
}

export interface PaginationMeta {
    current_page: number;
    from: number;
    last_page: number,
    per_page: number;
    to: number;
    total: number
}

export interface ResponseWrap<T> {
    data: T,
    meta?: PaginationMeta,
    links?: Links, 
}
